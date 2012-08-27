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
				'actions'=>array('create','update','JSONAtualizaRecurso','GeraCalendario','adminHistorico','admin','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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
			
			if(isset(Yii::app()->session['dadosReservas'])){
				$dadosReservas = Yii::app()->session['dadosReservas'];
				
				$qtdReservasAtuais = count($dadosReservas);
				
				// tratar limite máximo de reservas
				$criteria = new CDbCriteria;
				$criteria->compare('CDRecurso',$model->RRRecurso_CDRecurso);
				$resultadoR = RR_Recurso::model()->find($criteria);

				$criteria = new CDbCriteria;
				if(Yii::app()->user->name != 'admin'){
					$criteria->compare('Servidor_CDServidor',
					Yii::app()->user->getModelServidor()->CDServidor);
				}
				$criteria->compare('Dia','>='.date('Y-m-d'));
				$resultado = RR_ReservaRecurso::model()->findAll($criteria);
				$qtdReservas = count($resultado);

				if(($resultadoR->LimiteReserva < ($qtdReservas+$qtdReservasAtuais)) and (Yii::app()->user->name != 'admin')){
					$model->addError('Dia','Limite de reservas excedido.');
				}
				else{
					foreach($dadosReservas as $reserva){
						$modelR=new RR_ReservaRecurso;
						$modelR->RRRecurso_CDRecurso = $model->RRRecurso_CDRecurso;
						$modelR->Dia = $reserva[0];
					    $modelR->Horario = $reserva[1];
					    $modelR->save();
					}
					$this->redirect(array('admin','saveSuccess'=>true));					
				}
			}
			else{
				$model->addError('Horario','Selecione algum horário disponível.');
			}	
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
			// não é o ideal....rework...
			if(!is_null(Yii::app()->user->getModelServidor())){
				$criteria = new CDbCriteria;
				$criteria->compare('Servidor_CDServidor',
				Yii::app()->user->getModelServidor()->CDServidor);
				$criteria->compare('CDReservaRecurso',$this->loadModel()->CDReservaRecurso);
				$resultado = RR_ReservaRecurso::model()->find($criteria);
				if(!is_null($resultado)){
					$this->loadModel()->delete();
				}
				else{
					throw new CHttpException(400,'Você não pode fazer isso comunista...');
				}
				
				
			}
			else{
				   $this->loadModel()->delete();
			}
			
			

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
			
		if(isset($_GET['saveSuccess'])){
			$saveSuccess = $_GET['saveSuccess'];
		}
		else{
			$saveSuccess = null;
		}
		
		// para tamanho da página selecionada no gridview	
		if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
		}

		$this->render('admin',array(
			'model'=>$model,'saveSuccess'=>$saveSuccess,
		));
	}
	
	public function actionAdminHistorico()
	{
		$model=new RR_ReservaRecurso('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RR_ReservaRecurso']))
			$model->attributes=$_GET['RR_ReservaRecurso'];
			
		if(isset($_GET['saveSuccess'])){
			$saveSuccess = $_GET['saveSuccess'];
		}
		else{
			$saveSuccess = null;
		}
		
		// para tamanho da página selecionada no gridview	
		if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);
		}

		$this->render('adminHistorico',array(
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
		
		      if(isset($_POST['Periodo'])){
				$Periodo = $_POST['Periodo'];
		      }
		      else if(isset($_GET['Periodo'])){
			    $Periodo = $_GET['Periodo'];
		      }
		     

			 if(isset($_POST['RR_ReservaRecurso']['RRRecurso_CDRecurso'])){
				$idRecurso = $_POST['RR_ReservaRecurso']['RRRecurso_CDRecurso'];
			 }
			 else if(isset($_POST['TipoRecurso']) and !empty($_POST['TipoRecurso'])){

			 	 $TipoRecurso = $_POST['TipoRecurso'];
				 $data=RR_Recurso::model()->find(array('order'=>'NMRecurso',
				 'condition'=>'TipoRecurso_CDTipoRecurso=:TIPOREC',
			     'params'=>array(':TIPOREC'=>$TipoRecurso)));
			     if(is_null($data)){
				    $idRecurso = NULL;			
			     }
			     else{
				    $idRecurso = $data->CDRecurso;
			     }  
			 }
			 else if(isset($_GET['idRecurso'])){
				$idRecurso = $_GET['idRecurso'];
			 }
			 else{
				$idRecurso = NULL;
			 }
			
			 $criteria = new CDbCriteria;
			 $criteria->compare('CDRecurso',$idRecurso);
			 $resultadoRecurso = RR_Recurso::model()->find($criteria);

			 $criteria = new CDbCriteria;
			 $criteria->with = array('relTipoHorario');
			 $criteria->compare('relTipoHorario.CDHorario',
			 $resultadoRecurso->TipoHorario_CDHorario);
			 $Horarios = RR_Horario::model()->findAll($criteria);
			
			 $dados = array();
			 $dados['Horarios'] = $Horarios;
			 $dados['idRecurso'] = $idRecurso;
			 $dados['Periodo'] = $Periodo;
			 $dados['resultadoRecurso'] = $resultadoRecurso;
			 $dados['idsReservados'] = array();
			 if(isset($_GET['idReservar'])){
				$idReservar = $_GET['idReservar'];
				if(!isset(Yii::app()->session['ids_Reserva'])){
					$idsReserva = array();
		        }
		        else{
			        $idsReserva = Yii::app()->session['ids_Reserva'];
		        }
		        if($_GET['opRecurso'] == 0){
					$idsReserva[] = $idReservar;
					if(!isset(Yii::app()->session['dadosReservas'])){
						$dadosReserva = array();
					}
					else{
						$dadosReserva = Yii::app()->session['dadosReservas'];
					}
					$dadosReserva[] = array($_GET['dia'],$_GET['horario']);
					Yii::app()->session['dadosReservas'] = $dadosReserva;
		        }
		        else{
			        $dadosReserva = Yii::app()->session['dadosReservas'];
			        unset($dadosReserva[array_search($idReservar,$idsReserva)]);
			        Yii::app()->session['dadosReservas'] = $dadosReserva;
					
			        $idsReserva = array_diff($idsReserva, array($idReservar));
			           
		        }
		        
		        Yii::app()->session['ids_Reserva'] = $idsReserva;
		        $dados['idsReservados'] = $idsReserva; 
			 }
			 else{
			    //Remove variável de sessão responsável pelo controle da reserva dos recursos
				unset(Yii::app()->session['ids_Reserva']);	
				unset(Yii::app()->session['dadosReservas']);
			 }
			
			Yii::app()->session['idRecurso'] = $dados['idRecurso'];
			 
			 
			
			 $this->renderPartial('_calendar', $dados, false, true);

	
	}
	
}
