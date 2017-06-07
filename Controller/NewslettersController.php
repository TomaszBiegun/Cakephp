<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Created by PhpStorm.
 * User: Tomasz
 * Date: 15.06.2016
 * Time: 12:25
 */
class NewslettersController extends AppController
{
    /**
     * admin_index method.
     *
     * posylam grupowego maila z wiadomoscia
     * opcja newsletter w cms
     */
    public function admin_index()
    {
        $this->layout = 'admin';
        $this->loadModel('Pattern');
        $newsletters = $this->Paginator->paginate();
        $newsletters_acc = array();
        $newsletters_ids = array();
        $mails = array();
        $patterns = $this->Pattern->find('all');

        if ($this->request->is('post')) {

            $newsletter_ids = $this->request->data['Newsletter'];

            foreach ($newsletter_ids as $key => $newsletter_id) {
                if ($newsletter_id == 1) {
                    $newsletters_acc = $this->Newsletter->findById($key);
                    $mails[] = $newsletters_acc['Newsletter']['user_mail'];
                }


            }

            $Email = new CakeEmail('smtp');
            $Email->to($mails);
            $Email->template('custom', 'default');
            $Email->emailFormat('html');
            $Email->subject('GreenCook - Newsletter');
            $Email->viewVars(array(
                'content' => $this->request->data['Pattern']['body'],
                'link' => 'http://' . $_SERVER['SERVER_NAME']));
            $Email->send();

            if ($this->request->data['Pattern']['check'] == 1) {
                $data = $this->request->data['Pattern'];
                $this->Pattern->create();
                $this->Pattern->save($data);
            }
            $this->Flash->success('Wysłanie wiadomości');
            $this->redirect($this->referer());


        }
        $this->set(compact('newsletters', 'patterns'));
    }

    public function admin_delete($id = null)
    {
        $this->layout = 'admin';
        $this->render(false);
        $this->loadModel('Pattern');
        $this->Pattern->id = $id;
        if (!$this->Pattern->exists()) {
            throw new NotFoundException(__('Błędny identyfikator'));
        }

        if ($this->Pattern->delete()) {
            $this->Flash->success('Usunięcie szablonu');
        } else {
            $this->Flash->error('Usunięcie szablonu');
        }
        return $this->redirect(array('action' => 'index'));


    }

}