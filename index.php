<!doctype html5>
<head>
<title>Demo couchdb</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="script.js"></script>
<style>
textarea{ width: 500px; height:100px;}
.wrapper{ display: grid; grid-template-columns: 1fr 1fr}

</style>
</head>

<div class="wrapper">

<div>
<h2>Create</h2>
Criar um banco: 
<form id="form1" method="GET" action="api.php?request=createdb" > 
<input type="text" name="dbname" >
<input type="submit" value="Criar" />
</form>
<div id="resp-create"></div>

Criar um documento(JSON Válido):
<form id="form2" method="POST" action="api.php?request=createdoc" >
<label>Banco:</label>
<select name="database" id="menulista" >
</select><br>
<label>Documento:</label>
<textarea id="#docbody" name="docbody"></textarea>
<input type="submit" value="Criar" />
</form>
<div id="resp-doc-create"></div>

Exemplo:
<code><pre>
{
    "_id": "00a271787f89c0ef2e10e88a0c0001f4",
    "_rev": "1-2628a75ac8c3abfffc8f6e30c9949fd6",
    "item": "apple",
    "prices": {
        "Fresh Mart": 1.59,
        "Price Max": 5.99,
        "Apples Express": 0.79
    }
}</pre>
</code>
<div id="resp-create-doc"></div>

<h2>Read</h2>
Documentos no banco <select name="database" id="menulista1" ></select> 
<button type="submit" id="getDocuments">Buscar</button>
<ul id="documentosdb"></ul>
<h3>Update</h2>
</div>
<div>
<h2>Lista de bancos</h2>
<ul id="lista"></ul>
</div>

</div>
</html>
