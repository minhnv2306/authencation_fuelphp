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
        $config = $this->getPaginateConfig();
        $data['books'] = Book::paginate($config);
        $data['pagination'] = $this->editLinkPaginate($config);

        return \View::forge('book/index.twig', $data);

    }

    public function action_create()
    {
        return View::forge('book/create.twig');
    }

    public function action_store()
    {
        try {
            $rules = $this->getRules();
            $isValidate = $rules->run();

            if ($isValidate) {
                Book::createModel(Input::all());

                //tell the next page request which step to process
                Session::set_flash('message', 'Add new book successfully!');
                Response::redirect('book/index');
            } else {
                $data = $this->getErrorAndOldRequest($rules);
                $this->setErrorMessage($rules);

                return Response::forge(View::forge('book/create.twig')->set($data));
            }
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

    private function getRules()
    {
        $rules = Validation::forge();
        // Tham số thứ 2 là tên trường khi hiển thị lỗi validate không hợp lệ
        $rules->add_field('title', 'your username', 'required|min_length[3]');
        $rules->add_field('author', 'your password', 'required');
        $rules->add_field('price', 'your price', 'required');

        return $rules;
    }

    private function setErrorMessage($rules)
    {
        $rules->set_message('required', 'The field :label :field :value is required.');
        $rules->set_message('min_length', 'The field :label :field ":value" has to contain at least 3 characters.');
    }

    private function getErrorAndOldRequest($rules)
    {
        $errors = $rules->error();
        $oldRequest = $rules->validated();
        $data = [
            'errors' => $errors,
            'oldRequest' => $oldRequest,
        ];

        return $data;
    }

    private function getPaginateConfig()
    {
        $config = array(
            'pagination_url' => 'http://bookstore.local/book/index',
            'total_items'    => Book::count(),
            'per_page'       => 10,
            'uri_segment'    => 3,
            // or if you prefer pagination by query string
            //'uri_segment'    => 'page',
        );
        return Pagination::forge('mypagination', $config);
    }

    private function editLinkPaginate($config)
    {
        $temp = str_replace('</span>', '</li>', $config);
        return str_replace("<span","<li", $temp);
    }
}