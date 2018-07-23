<?php

use \Model\Book as Book;

class Controller_Book extends Controller {
    private $current_user;

    public function before()
    {
        parent::before();

        // Assign current_user to the instance so controllers can use it
        $this->current_user = Auth::check() ? Model_User::find(Arr::get(Auth::get_user_id(), 1)) : null;

        if (!Auth::check()) {
            Response::redirect('login/login');
        } else {
            return Response::forge(View::forge('product/add'));
        }

    }

    public function action_index() {

        $config = array(
            'pagination_url' => 'http://bookstore.local/book/index',
            'total_items'    => Book::count(),
            'per_page'       => 10,
            'uri_segment'    => 3,
            // or if you prefer pagination by query string
            //'uri_segment'    => 'page',
        );

        $pagination = Pagination::forge('mypagination', $config);

        $data['books'] = Book::query()
            ->rows_offset($pagination->offset)
            ->rows_limit($pagination->per_page)
            ->order_by('id','desc')
            ->get();

        // we pass the object, it will be rendered when echo'd in the view
        $temp = str_replace('</span>', '</li>', $pagination);
        $data['pagination'] = str_replace("<span","<li", $temp);

        // return the view
        return \View::forge('book/index.twig', $data);

    }

    public function action_create()
    {
        return View::forge('book/create.twig');
    }

    public function action_store()
    {
        try {
            Book::createModel(Input::all());

            //tell the next page request which step to process
            Session::set_flash('message', 'Add new book successfully!');
            Response::redirect('book/index');
        } catch (Orm\ValidationFailed $e) {
            Response::redirect_back()->set('errors', $e->getMessage(), false);
        }
    }

    public function action_show()
    {
        $book = Book::findOrFail(Request::active()->param('book'));

        return View::forge('book/show.twig')->set('book', $book);
    }

    public function action_update($id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->updateModel(Input::all());

            // tell the next page request which step to process
            Session::set_flash('message', 'Update successfully');

            Response::redirect('book/index');
        } catch (Orm\ValidationFailed $e) {
            Response::redirect_back()->set('errors', $e->getMessage(), false);
        }
    }
    public function action_destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->delete();

            // tell the next page request which step to process
            Session::set_flash('message', 'Delete successfully!');

            Response::redirect('book/index');
        } catch (Orm\ValidationFailed $e) {
            Response::redirect_back()->set('errors', $e->getMessage(), false);
        }
    }
}