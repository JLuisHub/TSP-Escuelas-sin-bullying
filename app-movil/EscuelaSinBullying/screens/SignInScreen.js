import { View, Text, StyleSheet, Alert } from 'react-native'
import React, {useState} from 'react'

import CustomInput from '../components/CustomInput'
import CustomButton from '../components/CustomButton'

import {useNavigation} from '@react-navigation/native'

const SignInScreen = () => {
    const [matricula, setMatricula] = useState('');
    const [password, setPassword] = useState('');

    const accesos = {'12345': 'contra123',
                    '12145': 'contra124',
                    '52345': 'contra1235'}

    const navigation = useNavigation()

    const onSignInPressed = () => {
        /*if (accesos[matricula]) {
            if (accesos[matricula] == password) {
                console.info("Sesion iniciada")
                navigation.navigate("ProfessorsHome")
            } else{
                console.error("Matricula o Contraseña incorrectos")
            }
        } else {
            console.error("Matricula o Contraseña incorrectos")
        }*/

        console.assert("Sesion iniciada")
        navigation.navigate("ProfessorsHome",{clave:12345})
        
        //InsertRecord()
        //tryAPI()
    }

    tryAPI = () => {
        fetch('http://192.168.1.131:8000/allEstudiantes', {
            method: 'GET'
            //Request Type 
        })
        .then((response) => response.json())
        //If response is in json then in success
        .then((response) => {
            //Success 

            console.log(response)
        })
        //If response is not in json then in error
        .catch((error) => {
            //Error 
            console.error(error);
        });
    }

    InsertRecord=()=>{
        var Matricula = matricula;
        var Password = password;
    
        if ((Matricula.length==0) || (Password.length==0)){
          alert("Required Field Is Missing!!!");
        }else{
          var APIURL = "http://127.0.0.1:8000/docs";
    
          var headers = {
            'Accept' : 'application/json',
            'Content-Type' : 'application/json'
          };
                
          var Data ={
            Matricula: Matricula,
            Password: Password
          };
    
          fetch(APIURL,{
            method: 'POST',
            headers: headers,
            body: JSON.stringify(Data)
          })
          .then((Response)=>Response.json())
          .then((Response)=>{
            alert(Response[0].Message)
            if (Response[0].Message == "Success") {
              console.log("true")
              this.props.navigation.navigate("Lista de Alumnos");
            }
            console.log(Data);
          })
          .catch((error)=>{
            console.error("ERROR FOUND" + error);
          })
        }
    }

  return (
    <View>
        <View style = {[styles.login_form_cont]}>

            <Text style = {[styles.login_input_name]}>Matricula</Text>
            <CustomInput 
                placeholder = "Matricula"
                value = {matricula}
                setValue = {setMatricula}
                keyboardType = 'number-pad'
                />
            
            <Text style = {[styles.login_input_name]}>Contraseña</Text>
            <CustomInput 
                placeholder = "Contraseña"
                value = {password}
                setValue = {setPassword}
                secureTextEntry
                />

            <View style = {[styles.CustomButtonCont]}>
                <CustomButton
                    text = 'Iniciar Sesión'
                    onPress = {onSignInPressed}
                    />
            </View>
        </View>
    </View>
  )
}

const styles = StyleSheet.create({
    login_form_cont: {
        width: '80%',
        alignSelf: "center",
        marginTop: "30%"
    },  

    login_input_name: {
        color: 'black',
        fontSize: 20,
        fontWeight: "bold",
        alignSelf: "center",
        marginBottom: 20
    },

    CustomButtonCont: {
        marginTop: 30,
        width: "70%",
        alignSelf: 'center'
    }

})

export default SignInScreen