// Call the dataTables jQuery plugin
$(document).ready(function() {
    var data=[];
    result = JSON.parse(sessionStorage.getItem("result"));
    for(var i=0;i<result.length;i++)
    {
      var book = result[i];
      var obj=
      {
           "#": (i+1).toString(),
           "Title" : book.title,
           "Date Modified" :book.dateModified,
           "Download File" : "<button class='btn btn-primary' name='download' id="+book.id+">Download</button>",
           "Size":book.size 
      };
      data.push(obj);
    }
    

     $('#dataTable').DataTable(
      {
       
        "lengthMenu": [
          [ 5, 10, 25, 50, -1 ],
          [ '5 rows', '10 rows', '25 rows', '50 rows', 'Show all' ]
          ],
        "pageLength": -1,
        "ordering":false,
        "columns":[
            {"data":"#"},
            {"data":"Title"},
            {"data":"Date Modified"},
            {"data":"Download File"},
            {"data":"Size"}
        ],
        "data": data
      });
      addEvents();
      $('#dataTable').DataTable().page.len(5).draw();
      
});

