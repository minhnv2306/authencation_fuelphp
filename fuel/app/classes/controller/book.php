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
        $data = $this->getDataWithPaginate();

        // handle cover_img
        foreach ($data['books'] as $item)
        {
            $item['cover_img'] = Asset::img($item['cover_img']);
            $item['cover_img'] = str_replace("<img","<img width=80%",$item['cover_img']);
        }

        return \View::forge('book/index.twig', $data);
    }

    public function action_create()
    {
        return View::forge('book/create.twig');
    }

    public function action_store()
    {
        $file = $this->saveCoverImage();
        $rules = $this->getRules();

        if ($rules->run()) {
            $this->saveBook($file['saved_as']);
            $this->handleSuccessResponse('Add new book successfully!');

            Response::redirect('book/index');
        } else {
            $data = $this->getErrorAndOldRequest($rules);
            $this->setErrorMessageValidate($rules);

            return Response::forge(View::forge('book/create.twig')->set($data));
        }
    }

    public function action_show()
    {
        $book = Book::findOrFail(Request::active()->param('book'));

        return View::forge('book/show.twig')->set('book', $book);
    }

    public function action_update($id)
    {
        $rules = $this->getRules();
        if ($rules->run()) {
            $this->updateBook($id, Input::all());
            $this->handleSuccessResponse('Update successfully');
        } else {
            $this->handleErrorResponse('Update fail!');
        }

        Response::redirect_back();
    }
    public function action_destroy($id)
    {
        Book::deleteModel($id);
        $this->handleSuccessResponse('Delete successfully!');

        Response::redirect('book/index');
    }

    private function getDataWithPaginate()
    {
        $config = $this->getPaginateConfig();
        $data['books'] = Book::paginate($config);
        $data['pagination'] = $this->editLinkPaginate($config);

        return $data;
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

    private function setErrorMessageValidate($rules)
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
        $config = Book::getConfigPaginate();

        return Pagination::forge('mypagination', $config);
    }

    private function editLinkPaginate($config)
    {
        $temp = str_replace('</span>', '</li>', $config);
        return str_replace("<span","<li", $temp);
    }

    private function handleSuccessResponse($message)
    {
        Session::set_flash('message', $message);
    }
    private function handleErrorResponse($message)
    {
        Session::set_flash('error', $message);
    }
    private function checkCoverImageFile()
    {
        // Custom configuration for this upload
        $config = array(
            'path' => DOCROOT . 'assets/img',
            'randomize' => true,
            'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
        );

        // process the uploaded files in $_FILES
        Upload::process($config);
        return Upload::is_valid();
    }

    private function saveCoverImage()
    {
        if ($this->checkCoverImageFile()) {
            Upload::save();

            return Upload::get_files(0);
        } else {
            $this->handleErrorResponse('Upload of files with this extension is not allowed');

            return Response::redirect_back();
        }
    }
    private function setInformationBook($coverImg)
    {
        $data = Input::all();
        $data['cover_img'] = $coverImg;

        return $data;
    }
    private function saveBook($coverPath)
    {
        $book = $this->setInformationBook($coverPath);
        Book::createModel($book);
    }

    private function updateBook($id, $request)
    {
        $book = Book::findOrFail($id);
        $book->updateModel($request);
    }
}