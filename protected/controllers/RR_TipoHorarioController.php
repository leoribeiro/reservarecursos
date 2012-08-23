<?php

class RR_TipoHorarioController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','AdicionaHorario','AdicionaHorarioOpcoes','DeletaHorario'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new RR_TipoHorario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RR_TipoHorario']))
		{
			$model->attributes=$_POST['RR_TipoHorario'];
			
			$HorariosEscolhidosSession = Yii::app()->session['HorariosEscolhidos_NMHorario'];

			$HorariosEscolhidos = array();
			
			for($x=0;$x<count($HorariosEscolhidosSession);$x++){
				if(!empty($_POST['HorarioAdiciona'.$x])){
					$HorariosEscolhidos[] = $_POST['HorarioAdiciona'.$x];
				}
			}
			
			for($x=0;$x<count($HorariosEscolhidos);$x++){
				
				$criteria = new CDbCriteria;
				$criteria->compare('NMHorario',$HorariosEscolhidos[$x]);
				$resultado = RR_Horario::model()->find($criteria);
				
				if(is_null($resultado)){
					$modelHorario = new RR_Horario;
					$modelHorario->NMHorario = $HorariosEscolhidos[$x];
					$modelHorario->save();
					$IdHorariosEscolhidos[] = $modelHorario->CDHorario;
				}
				else{
					$IdHorariosEscolhidos[] = $resultado->CDHorario;
				}
						
			}
			if(!empty($_POST['HorarioAdiciona']) and !in_array($_POST['HorarioAdiciona'],$HorariosEscolhidos)){
				
				$criteria = new CDbCriteria;
				$criteria->compare('NMHorario',$_POST['HorarioAdiciona']);
				$resultado = RR_Horario::model()->find($criteria);
				
				if(is_null($resultado)){
					$modelHorario = new RR_Horario;
					$modelHorario->NMHorario = $_POST['HorarioAdiciona'];
					$modelHorario->save();
					$IdHorariosEscolhidos[] = $modelHorario->CDHorario;
			    }
				else{
					$IdHorariosEscolhidos[] = $resultado->CDHorario;
				}
				
			}
			
			$model->relHorario = $IdHorariosEscolhidos;
			
			
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RR_TipoHorario']))
		{
			$model->attributes=$_POST['RR_TipoHorario'];			
			
			$HorariosEscolhidosSession = Yii::app()->session['HorariosEscolhidos_NMHorario'];

			$HorariosEscolhidos = array();
			
			for($x=0;$x<count($HorariosEscolhidosSession);$x++){
				if(!empty($_POST['HorarioAdiciona'.$x])){
					$HorariosEscolhidos[] = $_POST['HorarioAdiciona'.$x];
				}
			}	
			
			$IdHorariosEscolhidos = array();
			
			for($x=0;$x<count($HorariosEscolhidos);$x++){
				
				$criteria = new CDbCriteria;
				$criteria->compare('NMHorario',$HorariosEscolhidos[$x]);
				$resultado = RR_Horario::model()->find($criteria);
				
				if(is_null($resultado)){
					$modelHorario = new RR_Horario;
					$modelHorario->NMHorario = $HorariosEscolhidos[$x];
					$modelHorario->save();
					$IdHorariosEscolhidos[] = $modelHorario->CDHorario;
				}
				else{
					$IdHorariosEscolhidos[] = $resultado->CDHorario;
				}
				
			}
			if(!empty($_POST['HorarioAdiciona']) and !in_array($_POST['HorarioAdiciona'],$HorariosEscolhidos)){
				
				$criteria = new CDbCriteria;
				$criteria->compare('NMHorario',$_POST['HorarioAdiciona']);
				$resultado = RR_Horario::model()->find($criteria);
				
				if(is_null($resultado)){
					$modelHorario = new RR_Horario;
					$modelHorario->NMHorario = $_POST['HorarioAdiciona'];
					$modelHorario->save();
					$IdHorariosEscolhidos[] = $modelHorario->CDHorario;
			    }
				else{
					$IdHorariosEscolhidos[] = $resultado->CDHorario;
				}
				
			}
			
			$model->relHorario = $IdHorariosEscolhidos;
			
			
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('RR_TipoHorario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RR_TipoHorario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RR_TipoHorario']))
			$model->attributes=$_GET['RR_TipoHorario'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=RR_TipoHorario::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='rr--tipo-horario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionAdicionaHorario()
	{
		if(isset($_POST['HorarioAdiciona']) and !empty($_POST['HorarioAdiciona'])){
			$horario = $_POST['HorarioAdiciona'];
			
			
			// Não sei se é uma forma elegante, mas ainda não consegui resolver isto.
			// Usando uma variável de sessão para gravar as disciplinas escolhidas.
			if(!isset(Yii::app()->session['HorariosEscolhidos_NMHorario'])){
				$countHorariosEscolhidos = 0;	
			}
			else{
				$countHorariosEscolhidos = count(Yii::app()->session['HorariosEscolhidos_NMHorario']);	
			}
			$HorariosEscolhidos = array();
			for($x=0;$x<$countHorariosEscolhidos;$x++){
				$HorariosEscolhidos[] = $_POST['HorarioAdiciona'.$x];
			}

			if(!in_array($horario,$HorariosEscolhidos))
			   $HorariosEscolhidos[] = $horario;
	        
			Yii::app()->session['HorariosEscolhidos_NMHorario'] = $HorariosEscolhidos;

			$resultado = $HorariosEscolhidos;
		
		    $x=0;
		    foreach($resultado as $name)
		    {
				echo CHtml::textField('HorarioAdiciona'.$x,$name,array('size'=>20,'maxlength'=>20));
				echo "<br />";
				$x++;
		        
		    }
			echo CHtml::textField('HorarioAdiciona','',array('size'=>20,'maxlength'=>20));
			echo CHtml::ajaxLink(CHtml::image($this->createUrl('images/add.png'),'Adicionar horário'), 
			$this->createUrl('RR_TipoHorario/AdicionaHorario'),
			array(
				'type' =>'POST',
			    'update'=>'#horarios_selecionados', //selector to update
			));
		

		}
	
	}

	
	public function actionDeletaHorario(){
		echo 'asdasd';
	}
	
}
