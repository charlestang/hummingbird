# Hummingbird Documentation

## Table of Contents

* [AppAsset](#appasset)
* [CodeMirror](#codemirror)
    * [init](#init)
    * [run](#run)
* [CodeMirrorAsset](#codemirrorasset)
* [CsvHelper](#csvhelper)
    * [exportDataAsCsv](#exportdataascsv)
* [Database](#database)
    * [tableName](#tablename)
    * [rules](#rules)
    * [behaviors](#behaviors)
    * [attributeLabels](#attributelabels)
    * [getReports](#getreports)
    * [find](#find)
    * [delete](#delete)
    * [getDsn](#getdsn)
* [DatabaseController](#databasecontroller)
    * [behaviors](#behaviors-1)
    * [actionIndex](#actionindex)
    * [actionCreate](#actioncreate)
    * [actionUpdate](#actionupdate)
    * [actionDelete](#actiondelete)
* [DatabaseQuery](#databasequery)
    * [all](#all)
    * [one](#one)
    * [dropdownOptions](#dropdownoptions)
* [DateTimePicker](#datetimepicker)
    * [run](#run-1)
* [DateTimePickerAsset](#datetimepickerasset)
* [EditorAsset](#editorasset)
* [FavMenuHelper](#favmenuhelper)
    * [getFavMenuItems](#getfavmenuitems)
* [ListAsset](#listasset)
* [Log](#log)
    * [tableName](#tablename-1)
    * [rules](#rules-1)
    * [behaviors](#behaviors-2)
    * [attributeLabels](#attributelabels-1)
    * [getDatabase](#getdatabase)
    * [find](#find-1)
    * [log](#log-1)
* [LoginForm](#loginform)
    * [rules](#rules-2)
    * [validatePassword](#validatepassword)
    * [login](#login)
    * [getUser](#getuser)
* [LogQuery](#logquery)
    * [all](#all-1)
    * [one](#one-1)
* [MenuHelper](#menuhelper)
    * [getMenuItemParser](#getmenuitemparser)
    * [menuItemParser](#menuitemparser)
* [MomentAsset](#momentasset)
* [Report](#report)
    * [tableName](#tablename-2)
    * [rules](#rules-3)
    * [behaviors](#behaviors-3)
    * [attributeLabels](#attributelabels-2)
    * [getDatabase](#getdatabase-1)
    * [getUser](#getuser-1)
    * [find](#find-2)
    * [initEmptyRecord](#initemptyrecord)
* [ReportController](#reportcontroller)
    * [behaviors](#behaviors-4)
    * [actionCreate](#actioncreate-1)
    * [actionSave](#actionsave)
    * [actionList](#actionlist)
    * [actionUpdate](#actionupdate-1)
    * [actionExportQuery](#actionexportquery)
    * [actionExportById](#actionexportbyid)
    * [actionExportByReportId](#actionexportbyreportid)
    * [actionView](#actionview)
    * [actionDelete](#actiondelete-1)
* [ReportQuery](#reportquery)
    * [all](#all-2)
    * [one](#one-2)
    * [valid](#valid)
* [SiteController](#sitecontroller)
    * [behaviors](#behaviors-5)
    * [actions](#actions)
    * [actionIndex](#actionindex-1)
    * [actionLogin](#actionlogin)
    * [actionLogout](#actionlogout)
    * [actionResetPassword](#actionresetpassword)
* [SqlForm](#sqlform)
    * [rules](#rules-4)
    * [parse](#parse)
    * [execute](#execute)
    * [createDbConnection](#createdbconnection)
    * [validateSql](#validatesql)
    * [getBeautifiedVersion](#getbeautifiedversion)
    * [getTimeSpent](#gettimespent)
    * [getParameters](#getparameters)
* [Subscription](#subscription)
    * [tableName](#tablename-3)
    * [rules](#rules-5)
    * [behaviors](#behaviors-6)
    * [attributeLabels](#attributelabels-3)
    * [subscribe](#subscribe)
    * [isSubscribed](#issubscribed)
    * [unsubscribe](#unsubscribe)
    * [getReport](#getreport)
    * [getUser](#getuser-2)
    * [find](#find-3)
* [SubscriptionController](#subscriptioncontroller)
    * [actionList](#actionlist-1)
    * [actionToggle](#actiontoggle)
    * [actionDelete](#actiondelete-2)
* [SubscriptionQuery](#subscriptionquery)
    * [all](#all-3)
    * [one](#one-3)
* [User](#user)
    * [init](#init-1)
    * [tableName](#tablename-4)
    * [rules](#rules-6)
    * [behaviors](#behaviors-7)
    * [attributeLabels](#attributelabels-4)
    * [findByUsername](#findbyusername)
    * [validatePassword](#validatepassword-1)
    * [setPassword](#setpassword)
    * [getPassword](#getpassword)
    * [getId](#getid)
    * [generateAuthKey](#generateauthkey)
    * [changeAuthKey](#changeauthkey)
    * [getAuthKey](#getauthkey)
    * [validateAuthKey](#validateauthkey)
    * [findIdentity](#findidentity)
    * [findIdentityByAccessToken](#findidentitybyaccesstoken)
    * [ban](#ban)
* [UserController](#usercontroller)
    * [behaviors](#behaviors-8)
    * [actionIndex](#actionindex-2)
    * [actionView](#actionview-1)
    * [actionCreate](#actioncreate-2)
    * [actionUpdate](#actionupdate-2)
    * [actionBan](#actionban)

## AppAsset





* Full name: \app\assets\AppAsset
* Parent class: 


## CodeMirror

This widget will show a code editor on the web page.



* Full name: \app\widgets\codemirror\CodeMirror
* Parent class: 


### init



```php
CodeMirror::init(  )
```







---

### run



```php
CodeMirror::run(  )
```







---

## CodeMirrorAsset

小爬虫功能的SQL编辑器



* Full name: \app\widgets\codemirror\CodeMirrorAsset
* Parent class: 


## CsvHelper

Description of CsvHelper



* Full name: \app\components\CsvHelper


### exportDataAsCsv

CSV 数据导出助手

```php
CsvHelper::exportDataAsCsv( array $data, string $filename ): integer
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **array** | 数据数组, MySQL查询出来的关联数组 |
| `$filename` | **string** | CSV的文件名 |


**Return Value:**

文件的字节长度



---

## Database

This is the model class for table "database".



* Full name: \app\models\Database
* Parent class: 


### tableName



```php
Database::tableName(  )
```



* This method is **static**.



---

### rules



```php
Database::rules(  )
```







---

### behaviors



```php
Database::behaviors(  )
```







---

### attributeLabels



```php
Database::attributeLabels(  )
```







---

### getReports



```php
Database::getReports(  ): \yii\db\ActiveQuery
```







---

### find



```php
Database::find(  ): \app\models\DatabaseQuery
```



* This method is **static**.

**Return Value:**

the active query used by this AR class.



---

### delete



```php
Database::delete(  ): false|integer
```







---

### getDsn



```php
Database::getDsn(  )
```







---

## DatabaseController

DatabaseController implements the CRUD actions for Database model.



* Full name: \app\controllers\DatabaseController
* Parent class: 


### behaviors



```php
DatabaseController::behaviors(  )
```







---

### actionIndex

Lists all Database models.

```php
DatabaseController::actionIndex(  ): mixed
```







---

### actionCreate

Creates a new Database model.

```php
DatabaseController::actionCreate(  ): mixed
```

If creation is successful, the browser will be redirected to the 'view' page.





---

### actionUpdate

Updates an existing Database model.

```php
DatabaseController::actionUpdate( integer $id ): mixed
```

If update is successful, the browser will be redirected to the 'view' page.


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **integer** |  |




---

### actionDelete

Deletes an existing Database model.

```php
DatabaseController::actionDelete( integer $id ): mixed
```

If deletion is successful, the browser will be redirected to the 'index' page.


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **integer** |  |




---

## DatabaseQuery

This is the ActiveQuery class for [[Database]].



* Full name: \app\models\DatabaseQuery
* Parent class: 

**See Also:**

* \app\models\Database 

### all



```php
DatabaseQuery::all(  $db = null ): array&lt;mixed,\app\models\Database&gt;|array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$db` | **** |  |




---

### one



```php
DatabaseQuery::one(  $db = null ): \app\models\Database|array|null
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$db` | **** |  |




---

### dropdownOptions



```php
DatabaseQuery::dropdownOptions(  ): \app\models\DatabaseQuery
```







---

## DateTimePicker

Description of DateTimePicker



* Full name: \app\widgets\datetimepicker\DateTimePicker
* Parent class: 


### run



```php
DateTimePicker::run(  )
```







---

## DateTimePickerAsset

Description of DateTimePickerAsset



* Full name: \app\widgets\datetimepicker\DateTimePickerAsset
* Parent class: 


## EditorAsset

Description of EditorAsset



* Full name: \app\widgets\codemirror\EditorAsset
* Parent class: 


## FavMenuHelper

Description of FavMenuHelper



* Full name: \app\components\FavMenuHelper


### getFavMenuItems



```php
FavMenuHelper::getFavMenuItems(  )
```



* This method is **static**.



---

## ListAsset

Description of ListAsset



* Full name: \app\assets\ListAsset
* Parent class: 


## Log

This is the model class for table "log".



* Full name: \app\models\Log
* Parent class: 


### tableName



```php
Log::tableName(  )
```



* This method is **static**.



---

### rules



```php
Log::rules(  )
```







---

### behaviors



```php
Log::behaviors(  )
```







---

### attributeLabels



```php
Log::attributeLabels(  )
```







---

### getDatabase



```php
Log::getDatabase(  ): \yii\db\ActiveQuery
```







---

### find



```php
Log::find(  ): \app\models\LogQuery
```



* This method is **static**.

**Return Value:**

the active query used by this AR class.



---

### log



```php
Log::log(  $user_id,  $database_id,  $sql,  $time_spent,  $error_code )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$user_id` | **** |  |
| `$database_id` | **** |  |
| `$sql` | **** |  |
| `$time_spent` | **** |  |
| `$error_code` | **** |  |




---

## LoginForm

LoginForm is the model behind the login form.



* Full name: \app\models\LoginForm
* Parent class: 


### rules



```php
LoginForm::rules(  ): array
```





**Return Value:**

the validation rules.



---

### validatePassword

Validates the password.

```php
LoginForm::validatePassword( string $attribute, array $params )
```

This method serves as the inline validation for password.


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$attribute` | **string** | the attribute currently being validated |
| `$params` | **array** | the additional name-value pairs given in the rule |




---

### login

Logs in a user using the provided username and password.

```php
LoginForm::login(  ): boolean
```





**Return Value:**

whether the user is logged in successfully



---

### getUser

Finds user by [[username]]

```php
LoginForm::getUser(  ): \app\models\User|null
```







---

## LogQuery

This is the ActiveQuery class for [[Log]].



* Full name: \app\models\LogQuery
* Parent class: 

**See Also:**

* \app\models\Log 

### all



```php
LogQuery::all(  $db = null ): array&lt;mixed,\app\models\Log&gt;|array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$db` | **** |  |




---

### one



```php
LogQuery::one(  $db = null ): \app\models\Log|array|null
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$db` | **** |  |




---

## MenuHelper

Description of MenuHelper



* Full name: \app\components\MenuHelper


### getMenuItemParser



```php
MenuHelper::getMenuItemParser(  )
```



* This method is **static**.



---

### menuItemParser



```php
MenuHelper::menuItemParser(  $menu )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$menu` | **** |  |




---

## MomentAsset

Description of MomentAsset



* Full name: \app\widgets\datetimepicker\MomentAsset
* Parent class: 


## Report

This is the model class for table "report".



* Full name: \app\models\Report
* Parent class: 


### tableName



```php
Report::tableName(  )
```



* This method is **static**.



---

### rules



```php
Report::rules(  )
```







---

### behaviors



```php
Report::behaviors(  )
```







---

### attributeLabels



```php
Report::attributeLabels(  )
```







---

### getDatabase



```php
Report::getDatabase(  ): \yii\db\ActiveQuery
```







---

### getUser



```php
Report::getUser(  ): \yii\db\ActiveQuery
```







---

### find



```php
Report::find(  ): \app\models\ReportQuery
```



* This method is **static**.

**Return Value:**

the active query used by this AR class.



---

### initEmptyRecord

Create a report model object and set values to fields according to
$attributes, and load default values to others if $loadDefaultValues is
true.

```php
Report::initEmptyRecord( array $attributes = array(), boolean $loadDefaultValues = true ): \self
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$attributes` | **array** |  |
| `$loadDefaultValues` | **boolean** |  |




---

## ReportController

Description of ReportController



* Full name: \app\controllers\ReportController
* Parent class: 


### behaviors



```php
ReportController::behaviors(  )
```







---

### actionCreate

Create a new report

```php
ReportController::actionCreate(  )
```







---

### actionSave

Save report

```php
ReportController::actionSave(  $id = null )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |




---

### actionList

List all saved reports

```php
ReportController::actionList(  )
```







---

### actionUpdate



```php
ReportController::actionUpdate(  $id )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |




---

### actionExportQuery

Report export

```php
ReportController::actionExportQuery(  )
```







---

### actionExportById



```php
ReportController::actionExportById(  $id )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |




---

### actionExportByReportId

Export report by report id

```php
ReportController::actionExportByReportId(  )
```







---

### actionView



```php
ReportController::actionView(  $id )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |




---

### actionDelete



```php
ReportController::actionDelete(  $id )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |




---

## ReportQuery

This is the ActiveQuery class for [[Report]].



* Full name: \app\models\ReportQuery
* Parent class: 

**See Also:**

* \app\models\Report 

### all



```php
ReportQuery::all(  $db = null ): array&lt;mixed,\app\models\Report&gt;|array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$db` | **** |  |




---

### one



```php
ReportQuery::one(  $db = null ): \app\models\Report|array|null
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$db` | **** |  |




---

### valid



```php
ReportQuery::valid(  )
```







---

## SiteController





* Full name: \app\controllers\SiteController
* Parent class: 


### behaviors



```php
SiteController::behaviors(  )
```







---

### actions



```php
SiteController::actions(  )
```







---

### actionIndex

Displays homepage.

```php
SiteController::actionIndex(  ): string
```







---

### actionLogin

Login action.

```php
SiteController::actionLogin(  ): string
```







---

### actionLogout

Logout action.

```php
SiteController::actionLogout(  ): string
```







---

### actionResetPassword



```php
SiteController::actionResetPassword(  )
```







---

## SqlForm

SqlForm is designed for SQL execution.

Every SQL will be processed after following steps:
- pre-process  replace variables by default value or given value
- validate     check if the SQL is read only
- run          send the SQL to server and retrieve the results
- post-process format the result

* Full name: \app\models\SqlForm
* Parent class: 


### rules



```php
SqlForm::rules(  )
```







---

### parse



```php
SqlForm::parse(  $sql )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$sql` | **** |  |




---

### execute



```php
SqlForm::execute(  $limit = false )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$limit` | **** |  |




---

### createDbConnection



```php
SqlForm::createDbConnection(  $database_id )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$database_id` | **** |  |




---

### validateSql



```php
SqlForm::validateSql(  $attribute,  $params )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$attribute` | **** |  |
| `$params` | **** |  |




---

### getBeautifiedVersion



```php
SqlForm::getBeautifiedVersion(  )
```







---

### getTimeSpent



```php
SqlForm::getTimeSpent(  )
```







---

### getParameters



```php
SqlForm::getParameters(  )
```







---

## Subscription

This is the model class for table "subscription".



* Full name: \app\models\Subscription
* Parent class: 


### tableName



```php
Subscription::tableName(  )
```



* This method is **static**.



---

### rules



```php
Subscription::rules(  )
```







---

### behaviors



```php
Subscription::behaviors(  )
```







---

### attributeLabels



```php
Subscription::attributeLabels(  )
```







---

### subscribe



```php
Subscription::subscribe(  $user_id,  $report_id )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$user_id` | **** |  |
| `$report_id` | **** |  |




---

### isSubscribed

Check if a user has already subscribed a report

```php
Subscription::isSubscribed( integer $user_id, integer $report_id ): boolean
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$user_id` | **integer** |  |
| `$report_id` | **integer** |  |




---

### unsubscribe



```php
Subscription::unsubscribe(  $user_id,  $report_id )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$user_id` | **** |  |
| `$report_id` | **** |  |




---

### getReport



```php
Subscription::getReport(  ): \yii\db\ActiveQuery
```







---

### getUser



```php
Subscription::getUser(  ): \yii\db\ActiveQuery
```







---

### find



```php
Subscription::find(  ): \app\models\SubscriptionQuery
```



* This method is **static**.

**Return Value:**

the active query used by this AR class.



---

## SubscriptionController

Description of SubscriptionController



* Full name: \app\controllers\SubscriptionController
* Parent class: 


### actionList



```php
SubscriptionController::actionList(  )
```







---

### actionToggle



```php
SubscriptionController::actionToggle(  $report_id )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$report_id` | **** |  |




---

### actionDelete



```php
SubscriptionController::actionDelete(  $id )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |




---

## SubscriptionQuery

This is the ActiveQuery class for [[Subscription]].



* Full name: \app\models\SubscriptionQuery
* Parent class: 

**See Also:**

* \app\models\Subscription 

### all



```php
SubscriptionQuery::all(  $db = null ): array&lt;mixed,\app\models\Subscription&gt;|array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$db` | **** |  |




---

### one



```php
SubscriptionQuery::one(  $db = null ): \app\models\Subscription|array|null
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$db` | **** |  |




---

## User

This is the model class for table "user".



* Full name: \app\models\User
* Parent class: 
* This class implements: \yii\web\IdentityInterface


### init



```php
User::init(  )
```







---

### tableName



```php
User::tableName(  )
```



* This method is **static**.



---

### rules



```php
User::rules(  )
```







---

### behaviors



```php
User::behaviors(  )
```







---

### attributeLabels



```php
User::attributeLabels(  )
```







---

### findByUsername

Finds user by username

```php
User::findByUsername( string $username ): static|null
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$username` | **string** |  |




---

### validatePassword

Validates password

```php
User::validatePassword( string $password ): boolean
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$password` | **string** | password to validate |


**Return Value:**

if password provided is valid for current user



---

### setPassword

Generates password hash from password and sets it to the model

```php
User::setPassword( string $password )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$password` | **string** |  |




---

### getPassword



```php
User::getPassword(  )
```







---

### getId



```php
User::getId(  )
```







---

### generateAuthKey

Generates "remember me" authentication key

```php
User::generateAuthKey(  )
```







---

### changeAuthKey



```php
User::changeAuthKey(  )
```







---

### getAuthKey



```php
User::getAuthKey(  )
```







---

### validateAuthKey



```php
User::validateAuthKey(  $authKey )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$authKey` | **** |  |




---

### findIdentity



```php
User::findIdentity(  $id )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |




---

### findIdentityByAccessToken



```php
User::findIdentityByAccessToken(  $token,  $type = null )
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$token` | **** |  |
| `$type` | **** |  |




---

### ban



```php
User::ban(  )
```







---

## UserController

UserController implements the CRUD actions for User model.



* Full name: \app\controllers\UserController
* Parent class: 


### behaviors



```php
UserController::behaviors(  )
```







---

### actionIndex

Lists all User models.

```php
UserController::actionIndex(  ): mixed
```







---

### actionView

Displays a single User model.

```php
UserController::actionView( integer $id ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **integer** |  |




---

### actionCreate

Creates a new User model.

```php
UserController::actionCreate(  ): mixed
```

If creation is successful, the browser will be redirected to the 'view' page.





---

### actionUpdate

Updates an existing User model.

```php
UserController::actionUpdate( integer $id ): mixed
```

If update is successful, the browser will be redirected to the 'view' page.


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **integer** |  |




---

### actionBan



```php
UserController::actionBan(  $id )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$id` | **** |  |




---



--------
> This document was automatically generated from source code comments on 2017-02-19 using [phpDocumentor](http://www.phpdoc.org/) and [cvuorinen/phpdoc-markdown-public](https://github.com/cvuorinen/phpdoc-markdown-public)
