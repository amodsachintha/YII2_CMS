<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Help';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <h4 id="versions">Versions</h4>

    <table class="table">
        <thead>
        <tr>
            <th>Version</th>
            <th>Date</th>
            <th>Changes</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><code class="highlighter-rouge">version 1</code></td>
            <td>20/12/2018</td>
            <td>Initial deployment</td>
        </tr>
        <tr>
            <td><code class="highlighter-rouge">version 2</code></td>
            <td>21/12/2018</td>
            <td>Added authentication via api keys</td>
        </tr>
        </tbody>
    </table>

    <h4 id="endpoints">Endpoints</h4>

    <table class="table">
        <thead>
        <tr>
            <th>Endpoint</th>
            <th>What it does</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><code class="highlighter-rouge">/api_scma/document</code></td>
            <td>Returns an array of Documents</td>
        </tr>
        <tr>
            <td><code class="highlighter-rouge">/api_scma/media</code></td>
            <td>Returns an array of Media records based on unique identifier.</td>
        </tr>
        </tbody>
    </table>

    <h4>Authentication</h4>
    <p>Each request to the api endpoints must be accompanied with a valid api key for the request to be processed by the server.</p>
    <p>
        <code>http://{hostname:port}/api_scma/document?key={API_KEY}</code>
        <a href="/api_scma/document?key=4ac1a2e928c00767e2119b94ab4d71ad" class="btn btn-default btn-sm" target="_blank"><kbd>GET</kbd> All Documents</a>
    </p>
    <p>
        <code>http://{hostname:port}/api_scma/media?id=1&key={API_KEY}</code>
        <a href="/api_scma/media/view?id=2&key=4ac1a2e928c00767e2119b94ab4d71ad" class="btn btn-default btn-sm" target="_blank"><kbd>GET</kbd> Media (ID=2)</a>
    </p>

</div>
