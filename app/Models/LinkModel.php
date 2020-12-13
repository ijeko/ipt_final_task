<?php


class LinkModel extends Model
{
    protected $table = 'links';
    protected $id;
    protected $fullurl;
    protected $shorturl;
    protected $user_id;

    public function setData($urldata)
    {
        $this->id = $urldata['id'];
        $this->fullurl = $urldata['fullurl'];
        $this->shorturl = $urldata['shorturl'];
        $this->user_id = $urldata['user_id'];
    }

    public function getAll()
    {

    }

    public function id()
    {
        return $this->id;

    }

    public function shorturl()
    {
        return $this->shorturl;

    }

    public function fullurl()
    {
        return $this->fullurl;

    }
    public function user_id()
    {
        return $this->user_id;

    }


}