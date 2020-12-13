<?php


class Links extends Controller
{
    public static function Show()
    {
        $sql = "SELECT * FROM `links` WHERE `user_id` =" . Auth::User()->id();
        $query = Connect::Mysql()->prepare($sql);
        $query->execute();
        $links = $query->fetchAll(PDO::FETCH_OBJ);
        $links = json_encode($links);
        echo $links;

    }

    public function Add()
    {
            $data = json_decode($_POST['data'], true);
            $validator = new Validator();
            $validate = $validator->checkLinks($data);
            if ($validate->getValidated()) {
                $db = new DB($validate, LinkModel::class);
                $db->Save();
                $message = $db->getMessage();
            } else {
                $message = $validator->getMessage();
                echo json_encode(['status' => 'failed', 'message' => $message]);
            }
            if ($message == 'pass') {
                echo json_encode(['status' => 'pass', 'message' => 'URL добавлен']);
            }
            if ($message == 'failed') {
                echo json_encode(['status' => 'failed', 'message' => 'Данные не сохранены']);
            }
            if ($message == 'exists') {
                echo json_encode(['status' => 'exists', 'message' => 'Такой URL или сокращение уже используется']);
            }
    }

    public function Delete()
    {
        $data = json_decode($_POST['data'], true);
        $sql = "DELETE FROM `links` WHERE `id` = " . $data['id'];
        $query = Connect::Mysql()->prepare($sql);
        $query->execute();
        echo json_encode(['status'=>'pass', 'message'=> 'Сокращение удалено']);
    }
}