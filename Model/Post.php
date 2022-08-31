<?php 
class Post extends AppModel {
  
    public $name = 'Post';
    public $validate = array(
            'title' => array(
                'required' => array(
                    'rule' => array('notBlank'),
                    'message' => 'Preciso de um titulo')
                ),
                'body' => array(
                    'required' => array(
                        'rule' => array('notBlank'),
                        'message' => 'Preciso de um titulo')
                )
                );
                public function isOwnedBy($post, $user) {
                    return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
                }

             
}