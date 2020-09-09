function load_ajax(){
 	const ajax = new XMLHttpRequest();
 	ajax.open('GET', 'data-v2.json', true);
 	ajax.onreadystatechange = function(){
 		if(this.readyState ===4 && this.status ===200){
 			let data = JSON.parse(this.responseText)
 			for (var i=0; i<data.length; i++) {
			   document.getElementById('myTable').innerHTML +=
			   
				'<td>'+ data[i].id +'</td>'+
				'<td>'+ data[i].nama +'</td>'+
				'<td>'+ data[i].nis +'</td>'+
				'<td>'+ 
				'<a href="#route-update{{'+ data[i].id +'}}" class="btn btn-info">Detail Nilai</a>'+
				'</td>'
				
			   ;
			}
 		}
 	}
 	ajax.send();
 }
 load_ajax();