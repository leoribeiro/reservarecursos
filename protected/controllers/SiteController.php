<?php

class SiteController extends Controller
{
	var $defaultAction = 'index';
	
	
	
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		if(Yii::app()->user->isGuest){
			$this->redirect(array('Site/login'));	
		}
		else{
			$modelEstatistica = null;				
			}

			
			$this->render('index',array('modelEstatistica'=>''));
			//$this->renderPartial('Requerimentos/Estatisticas');
		
		
	}
	
	public function actionAguarde()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->renderPartial('aguarde');

	}
	

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
		    // Adicionado Por Leo Ribeiro 22-11-2011. Para tratar erros de referência em tabelas.
			//$error = Erros::trataErro($error);
			
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			$model->opSistema = "Requerimentos";
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				// definir permissões para os usuários de administração
				// Registro escolar, coordenações, etc...
				// não é o ideal, é necessário um rework.
				// mas como o tempo tá escasso vamos lá
				$permRR = false;
				$permRT = false;
				$permRG = false;
				$permRE = false;
				$permRF = false;

				if(!is_null(Yii::app()->user->getModelServidor())){
					$criteria = new CDbCriteria;
			        $criteria->compare('Servidor_CDServidor',
			        Yii::app()->user->getModelServidor()->CDServidor);
			        $modelsMRS =SS_ModeloRequerimentoServidor::model()->findAll($criteria);

					foreach($modelsMRS as $model){
						switch($model->SS_ModeloRequerimento_CDModeloRequerimento){
							case 1:
								$permRR = true;
								break;
							case 2:
								$permRT = true;
								break;	
							case 3:
								$permRG = true;
								break;	
							case 4:
								$permRE = true;
								break;	
							case 5:
								$permRF = true;
								break;			
						}
					}
				}

				Yii::app()->getSession()->add('permRR', $permRR);
				Yii::app()->getSession()->add('permRT', $permRT);
				Yii::app()->getSession()->add('permRG', $permRG);
				Yii::app()->getSession()->add('permRE', $permRE);
				Yii::app()->getSession()->add('permRF', $permRF);
				
				$this->redirect(Yii::app()->user->returnUrl);
			}
				
				
			if($model->novoAluno()){
				$matricula = $model->dadosAluno[0];
				$nomecompleto = $model->dadosAluno[1];
				$email = $model->dadosAluno[2];
				$tipoAluno = $model->dadosAluno[4];
				$password = $model->dadosAluno[3];
				$this->redirect(array($tipoAluno.'/create','matricula'=>$matricula,
				'nomecompleto'=>$nomecompleto,'email'=>$email,'tipoAluno'=>$tipoAluno));
			}	
			
		}
		

		
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
	public function actionJSONCursoGraduacao()
	{   
	        $criteria = new CDbCriteria;
	        $criteria->order = 'NMCurso ASC' ;
	        $data =CursoGraduacao::model()->findAll($criteria);

	        $data=CHtml::listData($data,'CDCurso','NMCurso');

	        echo CHtml::tag('option',
	                       array('value'=>''),'',true);

	        foreach($data as $value=>$name)
	        {
	            echo CHtml::tag('option',
	                       array('value'=>$value),CHtml::encode($name),true);
	        }
	        Yii::app()->end();
	 }
	
	public function actionJSONCursoTecnico()
	{   
	        $criteria = new CDbCriteria;
	        $criteria->order = 'NMCurso ASC' ;
	        $data =CursoTecnico::model()->findAll($criteria);

	        $data=CHtml::listData($data,'CDCurso','NMCurso');

	        echo CHtml::tag('option',
	                       array('value'=>''),'',true);

	        foreach($data as $value=>$name)
	        {
	            echo CHtml::tag('option',
	                       array('value'=>$value),CHtml::encode($name),true);
	        }
	        Yii::app()->end();
	 }
	
	public function actionJSONOpcaoRequerimento()
	{   
	        $criteria = new CDbCriteria;
	        $criteria->order = 'NMOpcao ASC' ;
	        $data =SS_Opcao::model()->findAll($criteria);

	        $data=CHtml::listData($data,'CDOpcao','NMOpcao');

	        echo CHtml::tag('option',
	                       array('value'=>''),'',true);

	        foreach($data as $value=>$name)
	        {
	            echo CHtml::tag('option',
	                       array('value'=>$value),CHtml::encode($name),true);
	        }
	        Yii::app()->end();
	 }
	
	public function actionJSONSituacao()
	{   
	        $criteria = new CDbCriteria;
	        $criteria->order = 'NMsituacao ASC' ;
	        $data =SS_Situacao::model()->findAll($criteria);

	        $data=CHtml::listData($data,'CDSituacao','NMsituacao');

	        echo CHtml::tag('option',
	                       array('value'=>''),'',true);

	        foreach($data as $value=>$name)
	        {
	            echo CHtml::tag('option',
	                       array('value'=>$value),CHtml::encode($name),true);
	        }
	        Yii::app()->end();
	 }

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionPopulaServidores(){
		
		$model = Servidor::model()->findAll();
		foreach($model as $registro){
			$modelUsuario = new Usuario;
			$modelUsuario->NMUsuario = $registro->LoginServidor;
			$modelUsuario->Servidor_CDServidor = $registro->CDServidor;
			$modelUsuario->save();

		}
		$this->renderPartial('aguarde');

	}
	
	public function actionPopulaAlunos(){
		
		$model = Aluno::model()->findAll();
		foreach($model as $registro){
			$modelUsuario = new Usuario;
			$modelUsuario->NMUsuario = $registro->NumMatricula;
			$modelUsuario->Aluno_CDAluno = $registro->CDAluno;
			$modelUsuario->save();

		}
		$this->renderPartial('aguarde');

	}
	

}