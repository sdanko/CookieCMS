<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * RolesUsers Controller
 *
 * @property \App\Model\Table\RolesUsersTable $RolesUsers
 */
class RolesUsersController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index($userId=null)
    {
//        $this->paginate = [
//            'contain' => ['Roles', 'Users']
//        ];
//        $this->set('rolesUsers', $this->paginate($this->RolesUsers));
//        $this->set('_serialize', ['rolesUsers']);
        if($userId==null) {
              $this->Flash->error(__d('croogo', 'Invalid user'));
              return $this->redirect('/admin');
        }
                       
         $query = $this->RolesUsers->Roles->find();
            $query->formatResults(function (\Cake\Datasource\ResultSetInterface $results) use($userId) {
                return $results->map(function ($row) use($userId){
                    $userRole = $this->RolesUsers->find()->where(['user_id' => $userId, 'role_id' => $row['id']])->first();
                    $row['active'] = $userRole ? true : false;
                    return $row;
                });
            });
            
            $roles = $this->paginate($query);
            
            $this->set('userId', $userId);
            
            $this->set(compact('roles')); 
    }

    /**
     * View method
     *
     * @param string|null $id Roles User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rolesUser = $this->RolesUsers->get($id, [
            'contain' => ['Roles', 'Users']
        ]);
        $this->set('rolesUser', $rolesUser);
        $this->set('_serialize', ['rolesUser']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rolesUser = $this->RolesUsers->newEntity();
        if ($this->request->is('post')) {
            $rolesUser = $this->RolesUsers->patchEntity($rolesUser, $this->request->data);
            if ($this->RolesUsers->save($rolesUser)) {
                $this->Flash->success(__('The roles user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The roles user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->RolesUsers->Roles->find('list', ['limit' => 200]);
        $users = $this->RolesUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('rolesUser', 'roles', 'users'));
        $this->set('_serialize', ['rolesUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Roles User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rolesUser = $this->RolesUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rolesUser = $this->RolesUsers->patchEntity($rolesUser, $this->request->data);
            if ($this->RolesUsers->save($rolesUser)) {
                $this->Flash->success(__('The roles user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The roles user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->RolesUsers->Roles->find('list', ['limit' => 200]);
        $users = $this->RolesUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('rolesUser', 'roles', 'users'));
        $this->set('_serialize', ['rolesUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Roles User id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rolesUser = $this->RolesUsers->get($id);
        if ($this->RolesUsers->delete($rolesUser)) {
            $this->Flash->success(__('The roles user has been deleted.'));
        } else {
            $this->Flash->error(__('The roles user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function activate($id = null, $userId=null)
    {
        $this->request->allowMethod(['post', 'activate']);
        $rolesUser = $this->RolesUsers->newEntity();
        $rolesUser->user_id=$userId;
        $rolesUser->role_id=$id;
        
        if ($this->RolesUsers->save($rolesUser)) {
            $this->Flash->success(__('User role has been activated.'));
            return $this->redirect(['action' => 'index', $userId]);
        } else {
            $this->Flash->error(__('User role could not be activated. Please, try again.'));
        }

    }
    
    public function deactivate($id = null, $userId=null)
    {
        $this->request->allowMethod(['post', 'deactivate']);
        $rolesUser = $this->RolesUsers->find()->where(['user_id' => $userId, 'role_id' => $id])->first();
        if ($this->RolesUsers->delete($rolesUser)) {
            $this->Flash->success(__('User has been deactivated.'));
        } else {
            $this->Flash->error(__('User role could not be deactivated. Please, try again.'));
        }
        return $this->redirect(['action' => 'index', $userId]);
    }
}
