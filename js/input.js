async function exec_post(){
    Url = "http://localhost/ass/control/rest.php";
    const postData = {
        ":username" : document.getElementById("username").value,
        ":password" : document.getElementById("password").value,
        ":fName" : document.getElementById("name").value,
        ":lName" : document.getElementById("sername").value,
    };
    console.log(postData);
    try{
        const response = await fetch(Url,{
            method:"post",
            headers:{"Content-Type":"application/json"},
            body: JSON.stringify(postData)    
        });

        if(!response.ok){
            const message = "Error with Status code:"+response.status;
            throw new Error(message);
        }
        const data = await response.json();
     /*    document.getElementById('div1').innerHTML = "<strong>"+data+"</strong>"; */
        console.log(data);
        if (data.Status=='ok') {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
              })
           setTimeout(()=>{
            window.location.href='login.php'
           },1900)
            
        }
    }catch(error){
        console.log("Error:"+error);
    }
  }
  