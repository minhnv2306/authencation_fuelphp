<?php
class Controller_Book extends Controller_Template {
    public $template = 'layout';
    private $current_user;

    public function before()
    {
        parent::before();

        // Assign current_user to the instance so controllers can use it
        $this->current_user = Auth::check() ? Model_User::find(Arr::get(Auth::get_user_id(), 1)) : null;

        if (!Auth::check()) {
            Response::redirect('login/login');
        } else {
            // Set a global variable for template so views can use it
            $this->template->name = $this->current_user->username;
        }

    }

    public function action_index() {
        // Create the view object
        //$view = View::forge('book/index');

        // fetch the book from database and set it to the view
        //$books = Model_Book::find('all');

        $books = DB::select('*')->from('book')->distinct(true)->execute();

        //$tests = DB::select('*')->from('book');
        //var_dump($tests);

        //$view->set('books', $books);


        $data = array(
            'books' => $books,
        );
        // set the template variables
        $this->template->title = "Book index page";
        $this->template->content = View::forge('book/index', $data);
        // $this->template->content = $view;
    }

    public function action_add() {

        // create a new fieldset and add book model
        $fieldset = Fieldset::forge('book')->add_model('Model_Book');

        // get form from fieldset
        $form = $fieldset->form();

        // add submit button to the form
        $form->add('Submit', '', array('type' => 'submit', 'value' => 'Submit'));

        // build the form  and set the current page as action
        $formHtml = $fieldset->build(Uri::create('book/add'));
        $view = View::forge('book/add');
        $view->set('form', $formHtml, false);

        if (Input::param() != array()) {
            try {
                $book = Model_Book::forge();
                $book->title = Input::param('title');
                $book->author = Input::param('author');
                $book->price = Input::param('price');
                $book->save();

                // tell the next page request which step to process
                Session::set_flash('message', 'hehe');

                Response::redirect('book');
            } catch (Orm\ValidationFailed $e) {
                $view->set('errors', $e->getMessage(), false);
            }
        }
        $this->template->title = "Book add page";
        $this->template->content = $view;
    }

    public function action_edit($id = false) {
        if(!($book = Model_Book::find($id))) {
            throw new HttpNotFoundException();
        }

        // create a new fieldset and add book model
        $fieldset = Fieldset::forge('book')->add_model('Model_Book');
        $fieldset->populate($book);

        // get form from fieldset
        $form = $fieldset->form();

        // add submit button to the form
        $form->add('Submit', '', array('type' => 'submit', 'value' => 'Submit'));

        // build the form  and set the current page as action
        $formHtml = $fieldset->build(Uri::create('book/edit/' . $id));
        $view = View::forge('book/add');
        $view->set('form', $formHtml, false);

        if (Input::param() != array()) {
            try {
                $book->title = Input::param('title');
                $book->author = Input::param('author');
                $book->price = Input::param('price');
                $book->save();
                Response::redirect('book');
            } catch (Orm\ValidationFailed $e) {
                $view->set('errors', $e->getMessage(), false);
            }
        }
        $this->template->title = "Book edit page";
        $this->template->content = $view;
    }

    public function action_delete($id = null) {
        if ( ! ($book = Model_Book::find($id))) {
            throw new HttpNotFoundException();

        } else {
            $book->delete();
        }
        Response::redirect('book');
    }
}