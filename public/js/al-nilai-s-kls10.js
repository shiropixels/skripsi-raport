function load_ajax(){
 	const ajax = new XMLHttpRequest();
 	ajax.open('GET', 'data-json/data-v2.json', true);
 	ajax.onreadystatechange = function(){
 		if(this.readyState ===4 && this.status ===200){
 			let data = JSON.parse(this.responseText)
 			for (var i=0; i<data.length; i++) {
			   document.getElementById('myTable').innerHTML +=
			  	
				'<td>'+ data[i].id +'</td>'+
				'<td scope="col">'+ data[i].nama +'</td>'+
				'<td>'+ data[i].phone +'</td>'
			   	
			   ;
			}
 		}
 	}
 	ajax.send();
 }
 load_ajax();