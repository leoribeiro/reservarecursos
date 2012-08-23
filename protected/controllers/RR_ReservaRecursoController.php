<?php

class RR_ReservaRecursoController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','JSONAtualizaRecurso','GeraCalendario'),
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
		$model=new RR_ReservaRecurso;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RR_ReservaRecurso']))
		{
			$model->attributes=$_POST['RR_ReservaRecurso'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->CDReservaRecurso));
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

		if(isset($_POST['RR_ReservaRecurso']))
		{
			$model->attributes=$_POST['RR_ReservaRecurso'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->CDReservaRecurso));
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
		$dataProvider=new CActiveDataProvider('RR_ReservaRecurso');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RR_ReservaRecurso('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RR_ReservaRecurso']))
			$model->attributes=$_GET['RR_ReservaRecurso'];

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
				$this->_model=RR_ReservaRecurso::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='rr--reserva-recurso-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionJSONAtualizaRecurso()
	{
		$TipoRecurso = $_POST['TipoRecurso'];
	    $data=RR_Recurso::model()->findAll(array('order'=>'NMRecurso','condition'=>'TipoRecurso_CDTipoRecurso=:TIPOREC',
	    'params'=>array(':TIPOREC'=>$TipoRecurso)));
	    $data=CHtml::listData($data,'CDRecurso','NMRecurso');
	    foreach($data as $value=>$name)
	    {
					echo CHtml::tag('option',
			                   array('value'=>$value),CHtml::encode($name),true);
	    }	
		
	}
	
	
	// Este gera calendário não está otimizado,
	// pelo contrário, está mal implementado
	// por falta de tempo vou deixar desta forma
	// a manutenção não é fácil
	public function actionGeraCalendario()
	{
		    function passPort($data){
				$dias_semana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabádo');
				$d = mktime(0,0,0,(int)substr($data, 3, 5),(int)substr($data, 0, 2),(int)substr($data, 6, 9));
				return $dias_semana[date("w", $d)];
			}
			
			function somarDia($data, $quantDias){
				$d = mktime(0,0,0,(int)substr($data, 3, 5),((int)substr($data, 0, 2))+$quantDias,(int)substr($data, 6, 9));
				return (date("d/m/Y",$d));
			}
			
			
		     $DataEscolhida = "22/08/2012";
		    
		     if(isset($_POST['RR_ReservaRecurso']['RRRecurso_CDRecurso'])){
				$idRecurso = $_POST['RR_ReservaRecurso']['RRRecurso_CDRecurso'];
		     }
		     else {
			     exit();
		     }
		     $criteria = new CDbCriteria;
			 $criteria->compare('CDRecurso',$idRecurso);
			 $resultadoRecurso = RR_Recurso::model()->find($criteria);
			 
			 $criteria = new CDbCriteria;
			 $criteria->with = array('relTipoHorario');
			 $criteria->compare('relTipoHorario.CDHorario',$resultadoRecurso->TipoHorario_CDHorario);
			 $Horarios = RR_Horario::model()->findAll($criteria);
			
		     
		
		     


			 $tabela  = "<table id=\"calendar\">";
			 $tabela .= "<tr>";
			 $tabela .= "<td colspan=9 class=\"month\">";
			 $tabela .= "Recurso: ".$resultadoRecurso->NMRecurso;			
			 $tabela .= "</td></tr>";
			 
			 // dias da semana
			 $tabela.= "<tr class=\"daynames\">"; 		
			 $tabela.= "<td>Horário</td>";
			 for($x=0;$x<8;$x++){
				$tabela .= "<td>";
				$tabela .= passPort(somarDia($DataEscolhida,$x));
				$tabela .= "<br />";
				$tabela .= somarDia($DataEscolhida,$x);
				$tabela .= "</td>";
			}
			$tabela .= "</tr>";
			
			 foreach($Horarios as $horario){
				$tabela .= "<tr class=\"weekres\">";
				$tabela .= "<td>".$horario->NMHorario."</td>";
				for($x=0;$x<8;$x++){
					$tabela .= "<td>";
					$tabela .= 'Disponível';
					$tabela .= "</td>";
				}
				$tabela .= "</tr>";
			 }
			
			$tabela .= "</table>";
			
			echo $tabela;
	
	}
	
}
