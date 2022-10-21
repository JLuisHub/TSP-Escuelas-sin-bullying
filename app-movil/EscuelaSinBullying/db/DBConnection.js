import { View, Text } from 'react-native'
import React from 'react'

export default function DBConnection() {
  var InsertAPIURL = "./SignUp.php";   //API to render signup
    //var InsertAPIURL = "http://10.0.2.2:80/SignIn/SignUp.php";   //API to render signup

    var headers = {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
        };
    
    var Data ={
        Email: Email,
        Password: Password
        };

    // FETCH func ------------------------------------
    fetch(InsertAPIURL,{
        method:'POST',
        headers:headers,
        body: JSON.stringify(Data) //convert data to JSON
    })
    .then((response)=>response.json()) //check response type of API (CHECK OUTPUT OF DATA IS IN JSON)
    .then((response)=>{
        alert(response[0].Message);       // If data is in JSON => Display alert msg
        this.props.navigation.navigate("SignInScreen"); //Navigate to next screen if authentications are valid
    })
    .catch((error)=>{
        alert("Error Occured" + error);
    })

  return (
    <View>
      <Text>DBConnection</Text>
    </View>
  )
}