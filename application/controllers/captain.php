<?php

class Captain_Controller extends Base_Controller {
  public function action_update($id) {
    $id += 1;
    $c = Captain::find($id);
    $data = Input::json();
    $c->votes = $data->votes;
    $c->save();
    var_dump($data);
    return "Why not, Zoidberg? Well, " . $c->name . " he's got votes: " .$data->votes;
  }

  public function action_create() {
    $data = Input::json();
    $cap = new Captain;
    $cap->name = $data->name;
    $cap->source = $data->source;
    $cap->imgUrl = $data->imgUrl;
    $cap->idx =  $data->idx;
    $cap->votes = 1;
    $cap->save();
    //return "Why not, Zoidberg? Well, " . $data->name;
    return Response::eloquent($cap);
  }
}
