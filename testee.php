<!DOCTYPE html PUBLIC
	"-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>PHP warning</title>

<style type="text/css">
/*<![CDATA[*/
html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,font,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td{border:0;outline:0;font-size:100%;vertical-align:baseline;background:transparent;margin:0;padding:0;}
body{line-height:1;}
ol,ul{list-style:none;}
blockquote,q{quotes:none;}
blockquote:before,blockquote:after,q:before,q:after{content:none;}
:focus{outline:0;}
ins{text-decoration:none;}
del{text-decoration:line-through;}
table{border-collapse:collapse;border-spacing:0;}

body {
	font: normal 9pt "Verdana";
	color: #000;
	background: #fff;
}

h1 {
	font: normal 18pt "Verdana";
	color: #f00;
	margin-bottom: .5em;
}

h2 {
	font: normal 14pt "Verdana";
	color: #800000;
	margin-bottom: .5em;
}

h3 {
	font: bold 11pt "Verdana";
}

pre {
	font: normal 11pt Menlo, Consolas, "Lucida Console", Monospace;
}

pre span.error {
	display: block;
	background: #fce3e3;
}

pre span.ln {
	color: #999;
	padding-right: 0.5em;
	border-right: 1px solid #ccc;
}

pre span.error-ln {
	font-weight: bold;
}

.container {
	margin: 1em 4em;
}

.version {
	color: gray;
	font-size: 8pt;
	border-top: 1px solid #aaa;
	padding-top: 1em;
	margin-bottom: 1em;
}

.message {
	color: #000;
	padding: 1em;
	font-size: 11pt;
	background: #f3f3f3;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	margin-bottom: 1em;
	line-height: 160%;
}

.source {
	margin-bottom: 1em;
}

.code pre {
	background-color: #ffe;
	margin: 0.5em 0;
	padding: 0.5em;
	line-height: 125%;
	border: 1px solid #eee;
}

.source .file {
	margin-bottom: 1em;
	font-weight: bold;
}

.traces {
	margin: 2em 0;
}

.trace {
	margin: 0.5em 0;
	padding: 0.5em;
}

.trace.app {
	border: 1px dashed #c00;
}

.trace .number {
	text-align: right;
	width: 2em;
	padding: 0.5em;
}

.trace .content {
	padding: 0.5em;
}

.trace .plus,
.trace .minus {
	display:inline;
	vertical-align:middle;
	text-align:center;
	border:1px solid #000;
	color:#000;
	font-size:10px;
	line-height:10px;
	margin:0;
	padding:0 1px;
	width:10px;
	height:10px;
}

.trace.collapsed .minus,
.trace.expanded .plus,
.trace.collapsed pre {
	display: none;
}

.trace-file {
	cursor: pointer;
	padding: 0.2em;
}

.trace-file:hover {
	background: #f0ffff;
}
/*]]>*/
</style>
</head>

<body>
<div class="container">
	<h1>PHP warning</h1>

	<p class="message">
		include(UsuarioSistema.php): failed to open stream: No such file or directory	</p>

	<div class="source">
		<p class="file">/Users/leonardoribeiro/Sites/yii-1.1.11/framework/YiiBase.php(423)</p>
		<div class="code"><pre><span class="ln">411</span>                         {
<span class="ln">412</span>                             include($classFile);
<span class="ln">413</span>                             if(YII_DEBUG &amp;&amp; basename(realpath($classFile))!==$className.&#039;.php&#039;)
<span class="ln">414</span>                                 throw new CException(Yii::t(&#039;yii&#039;,&#039;Class name &quot;{class}&quot; does not match class file &quot;{file}&quot;.&#039;, array(
<span class="ln">415</span>                                     &#039;{class}&#039;=&gt;$className,
<span class="ln">416</span>                                     &#039;{file}&#039;=&gt;$classFile,
<span class="ln">417</span>                                 )));
<span class="ln">418</span>                             break;
<span class="ln">419</span>                         }
<span class="ln">420</span>                     }
<span class="ln">421</span>                 }
<span class="ln">422</span>                 else
<span class="error"><span class="ln error-ln">423</span>                     include($className.&#039;.php&#039;);
</span><span class="ln">424</span>             }
<span class="ln">425</span>             else  // class name with namespace in PHP 5.3
<span class="ln">426</span>             {
<span class="ln">427</span>                 $namespace=str_replace(&#039;\\&#039;,&#039;.&#039;,ltrim($className,&#039;\\&#039;));
<span class="ln">428</span>                 if(($path=self::getPathOfAlias($namespace))!==false)
<span class="ln">429</span>                     include($path.&#039;.php&#039;);
<span class="ln">430</span>                 else
<span class="ln">431</span>                     return false;
<span class="ln">432</span>             }
<span class="ln">433</span>             return class_exists($className,false) || interface_exists($className,false);
<span class="ln">434</span>         }
<span class="ln">435</span>         return true;
</pre></div>	</div>

	<div class="traces">
		<h2>Stack Trace</h2>
				<table style="width:100%;">
						<tr class="trace core collapsed">
			<td class="number">
				#0			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/YiiBase.php(423): <strong>YiiBase</strong>::<strong>autoload</strong>()				</div>

				<div class="code"><pre><span class="ln">418</span>                             break;
<span class="ln">419</span>                         }
<span class="ln">420</span>                     }
<span class="ln">421</span>                 }
<span class="ln">422</span>                 else
<span class="error"><span class="ln error-ln">423</span>                     include($className.&#039;.php&#039;);
</span><span class="ln">424</span>             }
<span class="ln">425</span>             else  // class name with namespace in PHP 5.3
<span class="ln">426</span>             {
<span class="ln">427</span>                 $namespace=str_replace(&#039;\\&#039;,&#039;.&#039;,ltrim($className,&#039;\\&#039;));
<span class="ln">428</span>                 if(($path=self::getPathOfAlias($namespace))!==false)
</pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#1			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/YiiBase.php(298): <strong>YiiBase</strong>::<strong>autoload</strong>(&quot;UsuarioSistema&quot;)				</div>

				<div class="code"><pre><span class="ln">293</span>                     array(&#039;{alias}&#039;=&gt;$namespace)));
<span class="ln">294</span>         }
<span class="ln">295</span> 
<span class="ln">296</span>         if(($pos=strrpos($alias,&#039;.&#039;))===false)  // a simple class name
<span class="ln">297</span>         {
<span class="error"><span class="ln error-ln">298</span>             if($forceInclude &amp;&amp; self::autoload($alias))
</span><span class="ln">299</span>                 self::$_imports[$alias]=$alias;
<span class="ln">300</span>             return $alias;
<span class="ln">301</span>         }
<span class="ln">302</span> 
<span class="ln">303</span>         $className=(string)substr($alias,$pos+1);
</pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#2			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/YiiBase.php(198): <strong>YiiBase</strong>::<strong>import</strong>(&quot;UsuarioSistema&quot;, true)				</div>

				<div class="code"><pre><span class="ln">193</span>         }
<span class="ln">194</span>         else
<span class="ln">195</span>             throw new CException(Yii::t(&#039;yii&#039;,&#039;Object configuration must be an array containing a &quot;class&quot; element.&#039;));
<span class="ln">196</span> 
<span class="ln">197</span>         if(!class_exists($type,false))
<span class="error"><span class="ln error-ln">198</span>             $type=Yii::import($type,true);
</span><span class="ln">199</span> 
<span class="ln">200</span>         if(($n=func_num_args())&gt;1)
<span class="ln">201</span>         {
<span class="ln">202</span>             $args=func_get_args();
<span class="ln">203</span>             if($n===2)
</pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#3			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/base/CModule.php(387): <strong>YiiBase</strong>::<strong>createComponent</strong>(array(&quot;class&quot; =&gt; &quot;UsuarioSistema&quot;, &quot;allowAutoLogin&quot; =&gt; true))				</div>

				<div class="code"><pre><span class="ln">382</span>             $config=$this-&gt;_componentConfig[$id];
<span class="ln">383</span>             if(!isset($config[&#039;enabled&#039;]) || $config[&#039;enabled&#039;])
<span class="ln">384</span>             {
<span class="ln">385</span>                 Yii::trace(&quot;Loading \&quot;$id\&quot; application component&quot;,&#039;system.CModule&#039;);
<span class="ln">386</span>                 unset($config[&#039;enabled&#039;]);
<span class="error"><span class="ln error-ln">387</span>                 $component=Yii::createComponent($config);
</span><span class="ln">388</span>                 $component-&gt;init();
<span class="ln">389</span>                 return $this-&gt;_components[$id]=$component;
<span class="ln">390</span>             }
<span class="ln">391</span>         }
<span class="ln">392</span>     }
</pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#4			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/base/CModule.php(104): <strong>CModule</strong>-><strong>getComponent</strong>(&quot;user&quot;)				</div>

				<div class="code"><pre><span class="ln">099</span>      * @return mixed the named property value
<span class="ln">100</span>      */
<span class="ln">101</span>     public function __get($name)
<span class="ln">102</span>     {
<span class="ln">103</span>         if($this-&gt;hasComponent($name))
<span class="error"><span class="ln error-ln">104</span>             return $this-&gt;getComponent($name);
</span><span class="ln">105</span>         else
<span class="ln">106</span>             return parent::__get($name);
<span class="ln">107</span>     }
<span class="ln">108</span> 
<span class="ln">109</span>     /**
</pre></div>			</td>
		</tr>
						<tr class="trace app expanded">
			<td class="number">
				#5			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/ProjetoReservaRecursos/protected/controllers/SiteController.php(37): <strong>CModule</strong>-><strong>__get</strong>(&quot;user&quot;)				</div>

				<div class="code"><pre><span class="ln">32</span>      */
<span class="ln">33</span>     public function actionIndex()
<span class="ln">34</span>     {
<span class="ln">35</span>         // renders the view file &#039;protected/views/site/index.php&#039;
<span class="ln">36</span>         // using the default layout &#039;protected/views/layouts/main.php&#039;
<span class="error"><span class="ln error-ln">37</span>         if(Yii::app()-&gt;user-&gt;isGuest){
</span><span class="ln">38</span>             $this-&gt;redirect(array(&#039;Site/login&#039;));    
<span class="ln">39</span>         }
<span class="ln">40</span>         else{
<span class="ln">41</span>             $modelEstatistica = null;
<span class="ln">42</span>             if(Yii::app()-&gt;user-&gt;name == &#039;admin&#039; or
</pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#6			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/web/actions/CInlineAction.php(50): <strong>SiteController</strong>-><strong>actionIndex</strong>()				</div>

				<div class="code"><pre><span class="ln">45</span>         $controller=$this-&gt;getController();
<span class="ln">46</span>         $method=new ReflectionMethod($controller, $methodName);
<span class="ln">47</span>         if($method-&gt;getNumberOfParameters()&gt;0)
<span class="ln">48</span>             return $this-&gt;runWithParamsInternal($controller, $method, $params);
<span class="ln">49</span>         else
<span class="error"><span class="ln error-ln">50</span>             return $controller-&gt;$methodName();
</span><span class="ln">51</span>     }
<span class="ln">52</span> 
<span class="ln">53</span> }
</pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#7			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/web/CController.php(309): <strong>CInlineAction</strong>-><strong>runWithParams</strong>(array())				</div>

				<div class="code"><pre><span class="ln">304</span>     {
<span class="ln">305</span>         $priorAction=$this-&gt;_action;
<span class="ln">306</span>         $this-&gt;_action=$action;
<span class="ln">307</span>         if($this-&gt;beforeAction($action))
<span class="ln">308</span>         {
<span class="error"><span class="ln error-ln">309</span>             if($action-&gt;runWithParams($this-&gt;getActionParams())===false)
</span><span class="ln">310</span>                 $this-&gt;invalidActionParams($action);
<span class="ln">311</span>             else
<span class="ln">312</span>                 $this-&gt;afterAction($action);
<span class="ln">313</span>         }
<span class="ln">314</span>         $this-&gt;_action=$priorAction;
</pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#8			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/web/CController.php(287): <strong>CController</strong>-><strong>runAction</strong>(CInlineAction)				</div>

				<div class="code"><pre><span class="ln">282</span>      * @see runAction
<span class="ln">283</span>      */
<span class="ln">284</span>     public function runActionWithFilters($action,$filters)
<span class="ln">285</span>     {
<span class="ln">286</span>         if(empty($filters))
<span class="error"><span class="ln error-ln">287</span>             $this-&gt;runAction($action);
</span><span class="ln">288</span>         else
<span class="ln">289</span>         {
<span class="ln">290</span>             $priorAction=$this-&gt;_action;
<span class="ln">291</span>             $this-&gt;_action=$action;
<span class="ln">292</span>             CFilterChain::create($this,$action,$filters)-&gt;run();
</pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#9			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/web/CController.php(266): <strong>CController</strong>-><strong>runActionWithFilters</strong>(CInlineAction, array())				</div>

				<div class="code"><pre><span class="ln">261</span>         {
<span class="ln">262</span>             if(($parent=$this-&gt;getModule())===null)
<span class="ln">263</span>                 $parent=Yii::app();
<span class="ln">264</span>             if($parent-&gt;beforeControllerAction($this,$action))
<span class="ln">265</span>             {
<span class="error"><span class="ln error-ln">266</span>                 $this-&gt;runActionWithFilters($action,$this-&gt;filters());
</span><span class="ln">267</span>                 $parent-&gt;afterControllerAction($this,$action);
<span class="ln">268</span>             }
<span class="ln">269</span>         }
<span class="ln">270</span>         else
<span class="ln">271</span>             $this-&gt;missingAction($actionID);
</pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#10			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/web/CWebApplication.php(283): <strong>CController</strong>-><strong>run</strong>(&quot;&quot;)				</div>

				<div class="code"><pre><span class="ln">278</span>         {
<span class="ln">279</span>             list($controller,$actionID)=$ca;
<span class="ln">280</span>             $oldController=$this-&gt;_controller;
<span class="ln">281</span>             $this-&gt;_controller=$controller;
<span class="ln">282</span>             $controller-&gt;init();
<span class="error"><span class="ln error-ln">283</span>             $controller-&gt;run($actionID);
</span><span class="ln">284</span>             $this-&gt;_controller=$oldController;
<span class="ln">285</span>         }
<span class="ln">286</span>         else
<span class="ln">287</span>             throw new CHttpException(404,Yii::t(&#039;yii&#039;,&#039;Unable to resolve the request &quot;{route}&quot;.&#039;,
<span class="ln">288</span>                 array(&#039;{route}&#039;=&gt;$route===&#039;&#039;?$this-&gt;defaultController:$route)));
</pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#11			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/web/CWebApplication.php(142): <strong>CWebApplication</strong>-><strong>runController</strong>(&quot;&quot;)				</div>

				<div class="code"><pre><span class="ln">137</span>             foreach(array_splice($this-&gt;catchAllRequest,1) as $name=&gt;$value)
<span class="ln">138</span>                 $_GET[$name]=$value;
<span class="ln">139</span>         }
<span class="ln">140</span>         else
<span class="ln">141</span>             $route=$this-&gt;getUrlManager()-&gt;parseUrl($this-&gt;getRequest());
<span class="error"><span class="ln error-ln">142</span>         $this-&gt;runController($route);
</span><span class="ln">143</span>     }
<span class="ln">144</span> 
<span class="ln">145</span>     /**
<span class="ln">146</span>      * Registers the core application components.
<span class="ln">147</span>      * This method overrides the parent implementation by registering additional core components.
</pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#12			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/base/CApplication.php(162): <strong>CWebApplication</strong>-><strong>processRequest</strong>()				</div>

				<div class="code"><pre><span class="ln">157</span>      */
<span class="ln">158</span>     public function run()
<span class="ln">159</span>     {
<span class="ln">160</span>         if($this-&gt;hasEventHandler(&#039;onBeginRequest&#039;))
<span class="ln">161</span>             $this-&gt;onBeginRequest(new CEvent($this));
<span class="error"><span class="ln error-ln">162</span>         $this-&gt;processRequest();
</span><span class="ln">163</span>         if($this-&gt;hasEventHandler(&#039;onEndRequest&#039;))
<span class="ln">164</span>             $this-&gt;onEndRequest(new CEvent($this));
<span class="ln">165</span>     }
<span class="ln">166</span> 
<span class="ln">167</span>     /**
</pre></div>			</td>
		</tr>
						<tr class="trace app expanded">
			<td class="number">
				#13			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/ProjetoReservaRecursos/index.php(23): <strong>CApplication</strong>-><strong>run</strong>()				</div>

				<div class="code"><pre><span class="ln">18</span> $projetoRH = &#039;ProjetoRH&#039;;
<span class="ln">19</span> 
<span class="ln">20</span> Yii::setPathOfAlias(&#039;MarcacaoProva&#039;,&#039;../&#039;.$projetoMarcacao.&#039;/protected&#039;);
<span class="ln">21</span> Yii::setPathOfAlias(&#039;RecursosHumanos&#039;,&#039;../&#039;.$projetoRH.&#039;/protected&#039;);
<span class="ln">22</span> 
<span class="error"><span class="ln error-ln">23</span> Yii::createWebApplication($config)-&gt;run();
</span></pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#14			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/cli/commands/ShellCommand.php(80): <strong>require</strong>(&quot;/Users/leonardoribeiro/Sites/ProjetoReservaRecursos/index.php&quot;)				</div>

				<div class="code"><pre><span class="ln">75</span>         restore_exception_handler();
<span class="ln">76</span>         Yii::setApplication(null);
<span class="ln">77</span>         Yii::setPathOfAlias(&#039;application&#039;,null);
<span class="ln">78</span> 
<span class="ln">79</span>         ob_start();
<span class="error"><span class="ln error-ln">80</span>         $config=require($entryScript);
</span><span class="ln">81</span>         ob_end_clean();
<span class="ln">82</span> 
<span class="ln">83</span>         // oops, the entry script turns out to be a config file
<span class="ln">84</span>         if(is_array($config))
<span class="ln">85</span>         {
</pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#15			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/console/CConsoleCommandRunner.php(68): <strong>ShellCommand</strong>-><strong>run</strong>(array())				</div>

				<div class="code"><pre><span class="ln">63</span>             $name=&#039;help&#039;;
<span class="ln">64</span> 
<span class="ln">65</span>         if(($command=$this-&gt;createCommand($name))===null)
<span class="ln">66</span>             $command=$this-&gt;createCommand(&#039;help&#039;);
<span class="ln">67</span>         $command-&gt;init();
<span class="error"><span class="ln error-ln">68</span>         return $command-&gt;run($args);
</span><span class="ln">69</span>     }
<span class="ln">70</span> 
<span class="ln">71</span>     /**
<span class="ln">72</span>      * @return string the entry script name
<span class="ln">73</span>      */
</pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#16			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/console/CConsoleApplication.php(92): <strong>CConsoleCommandRunner</strong>-><strong>run</strong>(array(&quot;../yii-1.1.11/framework/yiic&quot;, &quot;shell&quot;))				</div>

				<div class="code"><pre><span class="ln">87</span>      * This method uses a console command runner to handle the particular user command.
<span class="ln">88</span>      * Since version 1.1.11 this method will exit application with an exit code if one is returned by the user command.
<span class="ln">89</span>      */
<span class="ln">90</span>     public function processRequest()
<span class="ln">91</span>     {
<span class="error"><span class="ln error-ln">92</span>         $exitCode=$this-&gt;_runner-&gt;run($_SERVER[&#039;argv&#039;]);
</span><span class="ln">93</span>         if(is_int($exitCode))
<span class="ln">94</span>             $this-&gt;end($exitCode);
<span class="ln">95</span>     }
<span class="ln">96</span> 
<span class="ln">97</span>     /**
</pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#17			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/base/CApplication.php(162): <strong>CConsoleApplication</strong>-><strong>processRequest</strong>()				</div>

				<div class="code"><pre><span class="ln">157</span>      */
<span class="ln">158</span>     public function run()
<span class="ln">159</span>     {
<span class="ln">160</span>         if($this-&gt;hasEventHandler(&#039;onBeginRequest&#039;))
<span class="ln">161</span>             $this-&gt;onBeginRequest(new CEvent($this));
<span class="error"><span class="ln error-ln">162</span>         $this-&gt;processRequest();
</span><span class="ln">163</span>         if($this-&gt;hasEventHandler(&#039;onEndRequest&#039;))
<span class="ln">164</span>             $this-&gt;onEndRequest(new CEvent($this));
<span class="ln">165</span>     }
<span class="ln">166</span> 
<span class="ln">167</span>     /**
</pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#18			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/yiic.php(34): <strong>CApplication</strong>-><strong>run</strong>()				</div>

				<div class="code"><pre><span class="ln">29</span> 
<span class="ln">30</span> $env=@getenv(&#039;YII_CONSOLE_COMMANDS&#039;);
<span class="ln">31</span> if(!empty($env))
<span class="ln">32</span>     $app-&gt;commandRunner-&gt;addCommands($env);
<span class="ln">33</span> 
<span class="error"><span class="ln error-ln">34</span> $app-&gt;run();</span></pre></div>			</td>
		</tr>
						<tr class="trace core collapsed">
			<td class="number">
				#19			</td>
			<td class="content">
				<div class="trace-file">
											<div class="plus">+</div>
						<div class="minus">–</div>
										&nbsp;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/yiic(15): <strong>require_once</strong>(&quot;/Users/leonardoribeiro/Sites/yii-1.1.11/framework/yiic.php&quot;)				</div>

				<div class="code"><pre><span class="ln">10</span>  * @copyright Copyright &amp;copy; 2008 Yii Software LLC
<span class="ln">11</span>  * @license http://www.yiiframework.com/license/
<span class="ln">12</span>  * @version $Id$
<span class="ln">13</span>  */
<span class="ln">14</span> 
<span class="error"><span class="ln error-ln">15</span> require_once(dirname(__FILE__).&#039;/yiic.php&#039;);
</span></pre></div>			</td>
		</tr>
				</table>
	</div>

	<div class="version">
		2012-08-14 11:00:11 <a href="http://www.yiiframework.com/">Yii Framework</a>/1.1.11	</div>
</div>

<script type="text/javascript">
/*<![CDATA[*/
var traceReg = new RegExp("(^|\\s)trace-file(\\s|$)");
var collapsedReg = new RegExp("(^|\\s)collapsed(\\s|$)");

var e = document.getElementsByTagName("div");
for(var j=0,len=e.length;j<len;j++){
	if(traceReg.test(e[j].className)){
		e[j].onclick = function(){
			var trace = this.parentNode.parentNode;
			if(collapsedReg.test(trace.className))
				trace.className = trace.className.replace("collapsed", "expanded");
			else
				trace.className = trace.className.replace("expanded", "collapsed");
		}
	}
}
/*]]>*/
</script>

</body>
</html>
