const queryString = document.getElementById("queryString");
const searchType = document.getElementById("searchByValue");
const btnSearch = document.getElementById("searchDocuments");
const linkIndexFile = document.getElementById("file-input");


btnSearch.onclick = (ev) => searchDocuments(ev);

function readAsText(file, done, doneContext){

    var fileReader = new FileReader;
    var c = doneContext || this;
    fileReader.onload = function(){
     done.call(c, fileReader.result);
     
    }

    fileReader.readAsText(file);

}

linkIndexFile.onchange = function(event) {
    var nameOfFile=this.files[0].name;
    $("#loadModal").modal("show");
    readAsText(this.files[0], function(res){
    const formData = new FormData();
    formData.append("indexFile",true);
    formData.append("title",nameOfFile);
    formData.append("content",res);
    const fetchData =
        {
                method:"POST",
                body: formData
        }
        fetch("../php/router.php",fetchData)
            .then(response =>
                {
                    if(!response.ok)
                        throw new Error(response.statusText);
                    else
                        return response.json();
   
                }).then((res) => {showResponse(res)})
   
                .catch(error => console.log(error));
           
      
       });

 }


function showResponse(response)
{
   $("#loadModal").modal("hide");
   const message=document.getElementById("messageContent");
   message.innerHTML=response;
   $("#myModal").modal("show");   
}

function searchDocuments(ev)
{
    const formData = new FormData();
    formData.append("query",queryString.value);
    formData.append("param",searchType.value);
    formData.append("searchFiles",true);
    const fetchData =
    {
        method:"POST",
        body: formData
    }
    fetch("../php/router.php",fetchData)
        .then(response =>
        {
            if(!response.ok)
                throw new Error(response.statusText);
            else
                return response.json();

        }).then((result) => showAsTable(result))
    
        .catch(error => console.log(error));

}

function showAsTable(result)
{
    if (typeof Storage !== "undefined") 
    { 
        sessionStorage.setItem("result", JSON.stringify(result));
    }
    window.location="table.html";
}
