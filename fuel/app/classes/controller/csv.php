<?php
/**
 * Created by PhpStorm.
 * User: FRAMGIA\nguyen.van.minhb
 * Date: 06/07/2018
 * Time: 10:48
 */
class Controller_CSV extends Controller
{
    public function action_export()
    {
        $books = DB::select('id', 'title', 'author', 'price')->from('book')->distinct(true)->execute()->as_array();

        // Response
        $response = new Response();

        // content-type: csv
        $response->set_header('Content-Type', 'application/csv');

        // ファイル名をセット: set name file
        $response->set_header('Content-Disposition', 'attachment; filename="a.csv"');

        // キャッシュをなしに
        $response->set_header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
        $response->set_header('Expires', 'Mon, 26 Jul 1997 05:00:00 GMT');
        $response->set_header('Pragma', 'no-cache');

        // CSVを出力: CSV output or view
        echo Format::forge($books)->to_csv();

        // Response
        return $response;
    }

    public function action_import()
    {
        return Response::forge(View::forge('csv/import'));
    }

    public function action_importfile()
    {
        //var_dump(Upload::get_files(0));
        $file_contents = file_get_contents(Upload::get_files(0)['file']);
        $array = Format::forge($file_contents, 'csv')->to_array();

        foreach ($array as $item) {
            echo $item['title'];
            echo "<br/>";
        }
        //var_dump($array);
    }

    public function action_getpdf()
    {
        $books = DB::select('id', 'title', 'author', 'price')->from('book')->distinct(true)->execute()->as_array();

        // Response
        $response = new Response();

        $response = new \Response();
        $response->set_header('Content-Type', 'application/octet-stream');
        $response->set_header('Content-Type', 'application/force-download');
        $response->set_header('Content-Length', '1024');
        $response->set_header('Content-Disposition', 'attachment; filename=a.pdf');
        $response->set_header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
        $response->set_header('Expires', date('r'));
        $response->set_header('Pragma', 'no-cache');
        $response->send(true);
        // CSVを出力: CSV output
        echo 1;

        // Response
        return $response;
    }

    public function action_gettxt()
    {
        $books = DB::select('id', 'title', 'author', 'price')->from('book')->distinct(true)->execute()->as_array();

        // Response
        $response = new Response();

        $response = new \Response();
        $response->set_header('Content-Type', 'application/pdf');
        $response->set_header('Content-Disposition', 'attachment; filename=a.txt');
        $response->set_header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate');
        $response->set_header('Expires', date('r'));
        $response->set_header('Pragma', 'no-cache');
        $response->send(true);
        // CSVを出力: CSV output
        echo Format::forge($books)->to_csv();

        // Response
        return $response;
    }
}