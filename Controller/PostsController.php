<?php
class PostsController extends AppController {
    public $helpers = array('Html', 'Form', 'Flash');
    public $components =  array('Flash');
    
    public function beforeFilter() {
        parent::beforeFilter(); 
    }
 

	
    public function index() {
        $condicoes = '1=1';
       
        if(isset($this->request->data['busca'])){
           
            $busca = $_POST['busca'];
            $_SESSION['busca'] = $busca;
            $condicoes .= " AND title  ilike ('%$busca%') "; 
        }
   
        if(isset($this->request->data['datainicio']) && $this->request->data['datafim']){
            $datainicio=date("Y-m-d", strtotime($_POST['datainicio']));
            $_SESSION['datainicio'] = $datainicio;
            $datafim= date("Y-m-d", strtotime($_POST['datafim']));
            $_SESSION['datafim'] = $datafim;
            $condicoes .=  " AND date(created) BETWEEN ('$datainicio') AND ('$datafim') "; 
        }





             $sql = "SELECT * FROM POSTS WHERE $condicoes";
            //  echo $sql;
            $rs = $this->Post->query($sql);
            $this->set('posts', $rs);
               
            $this->Session->write('posts',$condicoes);

        
    } 
    
    public function view($id = null) {
        $sql = "SELECT * FROM POSTS WHERE id = $id";
        $rs = $this->Post->query($sql);
        $this->set('posts', $rs);
        
    }
    
    public function add() {
            if ($this->request->is('post')) {
                $this->request->data['Post']['user_id'] = $this->Auth->user('id'); // Adicionada essa linha
                if ($this->Post->save($this->request->data)) {
                    $this->Flash->success('Você adicionou um post.');
                    $this->redirect(array('action' => 'index'));
                }
            }
        }
    
  
    public function logout() {
        $this->redirect($this->Auth->logout());

    
        
        
    }
    
    
    function delete($title) {
        if ($this->request->is('post')) { 
            $this->request->data = $this->Post->findById($title);
        }
        if ($this->Post->delete($title)) {
            $this->Flash->success('Voce Deletou o post');
            $this->redirect(array('action' => 'index'));
        }
    }
    public function edit($id = null) {
        
        $this->Post->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->Post->findById($id);
        } else {
            if ($this->Post->save($this->request->data)) { 
                $this->Flash->success('Post Editado');
						
                $this->redirect(array('action' => 'index'));

            }
        
     
    }
    }
    public function isAuthorized($user) {
        
            if ($this->action === 'add') {
                // Todos os usuários registrados podem criar posts
                return true;
            }
            if (in_array($this->action, array('edit', 'delete',))) {
                $postId = (int) $this->request->params['pass'][0];
                
                if ($this->Post->isOwnedBy($postId, $user['id'])) {
                    return true;
                }
            }
        
        return parent::isAuthorized($user);
    }
}