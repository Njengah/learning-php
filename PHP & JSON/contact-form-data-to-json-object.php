<!DOCTYPE html>

<html lang="en">

    <head>
        <style>
            /* Add a background color to body */ 
            body{    
                background:radial-gradient(circle at top left, rgba(233, 248, 255, 1), rgba(233, 248, 255, 0)) ;  
            }

                /* Add a background color and some padding around the form container */
                .form-container {
                border-radius: 5px;
                background-color: #cfd9d9;
                padding: 20px;
                max-width: 400px;
                margin-top: 50px;
                margin-right: auto;
                margin-bottom: 50px;
                margin-left: auto;
                font-family: arial;
                border : solid 1px #ddd; 
            }

            /* Add a color and some padding around the contact form heading */ 
            .wrap h3 {    
                margin: 0 auto; 
                font-family: arial; 
                max-width: 400px; 
                color: #555; 
                padding-top:20px; 
            }

                /* Style inputs with type="text", select elements and textareas */
                input[type=text], select, textarea {
                width: 100%; 
                padding: 12px; 
                border: 1px solid #ccc; 
                border-radius: 4px; 
                box-sizing: border-box; 
                margin-top: 6px; 
                margin-bottom: 16px; 
                resize: vertical 
                font-family: arial;
                font-size: 14px;
                }

                /* Style the submit button with a specific background color etc */
                #btn {
                background-color: #148C8C;
                color: white;
                padding: 12px 32px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                }

                /* When moving the mouse over the submit button, add a darker green color */
                #btn:hover {
                background-color: #333;
                }
    
        </style> 

    </head> 

<body> 

<div class ="wrap"> 

    <h3>Contact Form Data to JSON then to SQL </h3> 

    <div class="form-container">

         <form>

            <label for="fname">First Name</label>
                
                <input type="text" id="fname" name="firstname" placeholder="Your name..">

            <label for="lname">Last Name</label>
                
                <input type="text" id="lname" name="lastname" placeholder="Your last name..">

            <label for="subject">Subject</label>
                
                <textarea id="message" name="message" placeholder="Write something.." style="height:200px"></textarea>

            <div class="formBox">
                    <button id="btn">Send Message</button>
            </div>

        </form>

    </div> 

    <div id="msg">
                <pre></pre>
    </div>

</div> 


<!-- Convert the data submitted to JSON before we save it to SQl--> 


<script>
        let ContactData = [];

        const addContactData = (ev)=>{

            //to stop the form submitting
            
            ev.preventDefault();  

            let NewContactData = {
                id: Date.now(),
                firstName : document.getElementById('fname').value,
                lastName  : document.getElementById('lname').value,
                theMessage: document.getElementById('message').value,
            }
            ContactData.push(NewContactData);
            
            document.forms[0].reset(); // to clear the form for the next entries
            //document.querySelector('form').reset();

            //for display purposes only
            console.warn('added' , {ContactData} );

            let pre = document.querySelector('#msg pre');
            pre.textContent = '\n' + JSON.stringify(ContactData, '\t', 2);

            //saving to localStorage
            localStorage.setItem('MyContactData', JSON.stringify(ContactData) );
        }
        document.addEventListener('DOMContentLoaded', ()=>{
            document.getElementById('btn').addEventListener('click', addContactData);
        });


      // Post the stored data to the process-data.php file for further processing and sending to MySQL database 
      
        var storedData = localStorage.getItem('MyContactData');

        $.ajax({  
        type: "POST",  
            url: "process-data.php",  
            data: storedData;
        });


    </script>

</body>
</html>