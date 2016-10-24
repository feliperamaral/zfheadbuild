# Zend Framework 2/3 Head*Build Module

## Como funciona:
Hoje em dia é muito utilizado automatizadores de tarefas para front-end como `Grunt`, `Gulp` e etc.

Geralmente é utilizado `packages` para gerar `builds` do *CSS* e *JS* como `build/js/app-9783118bf8.js`

Então esse modulo é para justamente recupear essa versão de build e adicionar na sua `view` como:

VIEW.phtml:
```php
<?php
echo $this->headScript()->prependFileBuild('js/app.js');

```
HTML:
```html
<script type="text/javascript" src="/build/js/app-9783118bf8.js`"></script>
```

## Instalação
1. Adicione no composer.json do seu projeto
 

   

```json
 "require" : {
		"feliperamaral/zfheadbuild" : "1.*@stable"
    }
```
2. Rode o seguinte comando
```
$ php composer.phar update
```

## Após a instalação

### Opção 1 - Instalar como modulo

1. Adicione o modulo no seu `application.config.php`
```php
<?php
return array(
	'modules' => array(
    	//...
        'HeadBuild'
    ),
    //...
);
```
### Opção 2 - Adicione diretamente no seu modulo  *(recomendado)*

*Dessa forma não é preciso inicializar um modulo inteiro*

1. Adicione o seguinte helper no seu `[modulo]/config/module.config.php`
```php
<?php
return array(
    //...
    'view_helpers' => array(
    	//..
        'invokables' => array(
        	//...
            'headlink' => 'HeadBuild\View\Helper\HeadLink',
            'headscript' => 'HeadBuild\View\Helper\HeadScript',
        ),
    ),
);
```

### Configurações
Você pode configurar manualmente os caminhos para a sua pasta de *build*

Duas variáveis estão incluídas no processo, que são: `public_path` e `manifest_file`

O valor padrão de `manifest_file` é `build\rev-manifest.json`
O valor padrão de `public_path` é calculado automaticamente com base no seu `index.php` (ou qualquer arquivo que o seu `Rewrite` aponte)

###### Alterar configurações padrão
No seu arquivo de configuração `[modulo]/config/module.config.php`, adicione o seguinte:
```php
<?php

return [
    'headbuild' => [
        'public_path' => 'caminho/para/meu/public/',
        'manifest_file' => 'build-path\arquivo-json.json'
    ],
```



# Como usar 

É adicionado dinâmicamente a versão `...Build([...])` à todos os métodos dos helpers `HeadLink` e `HeadScript`

Na sua view: 

VIEW.phtml:
```php
<?php
echo $this->headLink()
	->appendStylesheetBuild('css/app.css')
    ->appendStylesheetBuild($this->basePath('css/lib.css'));
echo $this->headScript()
	->prependFileBuild('js/app.js')
    ->appendFile($this->basePath('js/lib.js'));

```
HTML:
```html
<link href="/my-application/build/css/app-f7bf2c660c.css" media="screen" rel="stylesheet" type="text/css">
<link href="/my-application/css/lib.css" media="screen" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/my-application/build/js/app-9783118bf8.js`"></script>
<script type="text/javascript" src="/my-application/js/lib.js"></script>
```
#### *Observe que não é preciso usar o `$this->basePath(...) no método de build`*
#### *Observe também que os outros métodos continuam funcionando normalmente*

*Todos os métodos possuem os mesmo parâmetros dos métodos equivalentes*

### Métodos `HeadScript`


```

$this->headScript()->appendFile([...]);
$this->headScript()->appendFileBuild([...]);

$this->headScript()->offsetSetFile([...]);
$this->headScript()->offsetSetFileBuild([...]);

$this->headScript()->prependFile([...]);
$this->headScript()->prependFileBuild([...]);

$this->headScript()->setFile([...]);
$this->headScript()->setFileBuild([...]);

$this->headScript()->appendScript([...]);
$this->headScript()->appendScriptBuild([...]);

$this->headScript()->offsetSetScript([...]);
$this->headScript()->offsetSetScriptBuild([...]);

$this->headScript()->prependScript([...]);
$this->headScript()->prependScriptBuild([...]);
```
### Métodos `HeadLink`
```php

$this->headLink()->appendStylesheet([...]);
$this->headLink()->appendStylesheetBuild([...]);

$this->headLink()->offsetSetStylesheet([...]);
$this->headLink()->offsetSetStylesheetBuild([...]);

$this->headLink()->prependStylesheet([...]);
$this->headLink()->prependStylesheetBuild([...]);

$this->headLink()->setStylesheet([...]);
$this->headLink()->setStylesheetBuild([...]);

$this->headLink()->appendAlternate([...]);
$this->headLink()->appendAlternateBuild([...]);

$this->headLink()->offsetSetAlternate([...]);
$this->headLink()->offsetSetAlternateBuild([...]);

$this->headLink()->prependAlternate([...]);
$this->headLink()->prependAlternateBuild([...]);

$this->headLink()->setAlternate([...]);
$this->headLink()->setAlternateBuild([...]);
```


```














