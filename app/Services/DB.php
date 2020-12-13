<?php

class DB
{
    protected $data;
    protected $model;
    protected $Message;

    public function __construct(Validator $validator, $model)
    {
        $this->data = $validator;
        $model = new $model();
        $model->setData($this->data->getValidated());
        $this->model = $model;
    }

    public function Save()
    {


        function objToArray($model)
        {
            $rowarray = (array)$model;
            foreach ($rowarray as $key => $val) {
                $model_array[str_replace('*', NULL, $key)] = $val;
            }
            return $model_array;
        }

        function getKeys($model_array, $needArray = false)
        {
            foreach ($model_array as $key => $value) {
                $model_keys[] = "`" . $key . "`";
            }
            if (!$needArray) {
                unset($model_keys[0]);
                unset($model_keys[1]);
                return $columns = implode(", ", $model_keys);
            }
            return $model_keys;

        }

        function getVals($model_array, $needArray = false)
        {
            foreach ($model_array as $key => $value) {
                $model_values[] = "'" . $value . "'";
            }
            if (!$needArray) {
                unset($model_values[0]);
                unset($model_values[1]);
                $values = implode(", ", $model_values);
                return $values;
            }
            return $model_values;

        }

        function getTable($model_array)
        {
            $model_values = getVals($model_array, true);
            $table = trim($model_values[0], "'");
            return $table;
        }

        $columns = getKeys(objToArray($this->model));
        $values = getVals(objToArray($this->model));
        $table = getTable(objToArray($this->model));
        $columns_array = getKeys(objToArray($this->model), true);
        $columns_array = array_slice($columns_array, 1, -1);
        $values_array = getVals(objToArray($this->model), true);
        $values_array = array_slice($values_array, 1, -1);
        unset($columns_array[0]);
        unset($values_array[0]);

        if (get_class($this->model) == LinkModel::class) {
            $id = Auth::User()->id();
        }
        
        if ($this->checkExists($table, $columns_array, $values_array, $id) == 1) {
            $sql = "INSERT INTO `" . $table . "` (`id`, " . $columns . ") VALUES (NULL, " . $values . ")";
            $query = Connect::Mysql()->prepare($this->clearString($sql));
            $query->execute();
            return $this->Message = "pass";
//                var_dump($this->Message);
//                echo "???";
        } else
            return $this->Message = "exists";


    }


    protected function clearString($string)
    {
        $old_string = $string;
        $string = strip_tags($string);
        $string = preg_replace('/([^\pL\pN\pP\pS\pZ])|([\xC2\xA0])/u', ' ', $string);
        $string = str_replace('  ', ' ', $string);
        $string = trim($string);

        if ($string === $old_string) {
            return $string;
        } else {
            return $this->clearString($string);
        }
    }

//    protected function Connect()
//    {
//        $user = 'root';
//        $password = 'root';
//        $db = 'tinylinks';
//        $host = '127.0.0.1:3306';
//        $dsn = 'mysql:host=' . $host . ';dbname=' . $db;
//        $pdo = new PDO($dsn, $user, $password);
//        return $pdo;
//    }

    public function checkExists($table, $columns, $values, $and = '')
    {
        if ($and) {
            $and_condition = ' AND `user_id` = ' . $and;
        }
        $i = 1;
//        print_r($table);
//        var_dump($columns);
//        var_dump($values);


        foreach ($columns as $column) {
            //    $result=[];
            //    echo $values[$i];
            $sql = "SELECT EXISTS(SELECT 1 FROM `" . $table . "` WHERE  " . trim($columns[$i], ' ') . " = " . $values[$i] . $and_condition . " LIMIT 1)";
            $stmt = Connect::Mysql()->prepare($this->clearString($sql));
            $stmt->execute();
            $i++;
            if ($stmt->fetch(PDO::FETCH_NUM)[0]) {
                //    echo "YES".$sql;

                return $result = 0;
            } else {
                //    echo "NO".$sql;

                $result = 1;
            }
        }

        return $result;
    }

    public function getMessage()
    {
        return $this->Message;
    }

    public function verify()
    {
        $email = $this->model->getData()['email'];
        $password = $this->model->getData()['password'];
        $sql = "SELECT `id` FROM `users` WHERE `email` = '" . $email . "' AND `password` = '" . $password . "'";
        $query = Connect::Mysql()->prepare($sql);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        if ($data != '') {
            $this->Message = ['status' => 'pass', 'message' => 'Пользоатель авторизован'];
            setcookie('userID', $data['id'], time() + 3600 * 24 * 30, '/');
        } else  $this->Message = ['status' => 'failed', 'message' => 'Неверно указан email или пароль'];

    }

    public static function getModel($model, $data)
    {
        $rowarray = (array)$model;
        foreach ($rowarray as $key => $val) {
            $model_array[str_replace('*', NULL, $key)] = $val;
        }
        foreach ($model_array as $key => $value) {
            $model_keys[] = "`" . $key . "`";
            $model_vals[] = "`" . $value . "`";

        }
        $table = $model_vals[0];
        if (property_exists($model, 'table')) {
            unset($model_keys[0]);
            unset($model_vals[0]);
        }

        $columns = implode(", ", $model_keys);
        $sql = "SELECT " . $columns . " FROM " . $table . " WHERE `" . $data[0] . "` = '" . $data[1] . "'";
        $query = Connect::Mysql()->prepare(preg_replace('/[\x00-\x1F\x7F]/u', '', $sql));
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $model = new $model;
            $model->setData($data);
            return $model;
        } else return false;

    }


}