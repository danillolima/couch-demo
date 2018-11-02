$(document).ready(function() {

	$.ajax({
		method: "GET",
		//contentType: "application/json; charset=utf-8",
		url: "http://127.0.0.1/demo/api.php?request=dbs",
		success: function(resp) {
			resp = JSON.parse(resp);
			resp.forEach(function(name){
				$("#lista").append('<li>' + name + '</li>');
				$("#menulista").append('<option value="' + name + '">' + name + '</option>');
				$("#menulista1").append('<option value="' + name + '">' + name + '</option>');
			})
		}
	});

	$("#form1").submit(function(e) {
		var form = $(this);
		var dbname = $('input[name="dbname"]').val();
		var url = form.attr('action') + '&dbname=' + dbname ;
		$.ajax({
			type: "GET",
			url: url,
			success: function(data){
					var response = JSON.parse(data);
					console.log(response);
					if(response.ok == true){
								$("#resp-create").text("Banco "+  dbname + " criado com sucesso.");
					}else{
						$("#resp-create").text("Erro criando banco");
					}
				}
			});
		e.preventDefault(); 
	});


	$("#getDocuments").click(function() {
		var menulista1 = $("#menulista1").val();
		var url = 'http://127.0.0.1/demo/api.php?request=readdocs&dbname=' + menulista1;
		$.ajax({
			type: "GET",
			url: url,
			success: function(data){
		 var response = JSON.parse(data);
		 console.log(Object.keys(response));
		if(response.total_rows > 0){
			$("#documentosdb").text(response.total_rows + " documentos encontrados!");
		response.rows.forEach(function(item){
			$("#documentosdb").append('<li>DOC ID: ' + item.key + '</li>');
		})
		 }else if(response.total_rows == 0){
			 $("#documentosdb").html("<li>Banco vazio.</li>");
		 }
		 else{
			$("#documentosdb").html("<li>Erro pegando documentos</li>");
		 }
			}
		  });
	});

	$("#form2").submit(function(e) {
		var menulista = $("#menulista").val();
		var url = 'api.php?request=createdoc&dbname=' + menulista;
		var dados = $("#form2").serialize();
		$.ajax({
			type: "POST",
			url: url,
			data: dados,
			success: function(data){
				var response = JSON.parse(data); 
				//console.log(response);
				//alert(Object.keys(response));
				if(response.ok === true){
					$("#resp-doc-create").html("<li>Documento criado!</li>");
				}
				else if(response.error){
					$("#resp-doc-create").html("<li>Erro criando documento: " + response.error + ' - ' + response.reason + "</li>");
				}
			}
		});
		e.preventDefault(); 
	});

});
