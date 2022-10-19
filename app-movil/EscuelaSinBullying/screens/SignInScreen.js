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
        //console.warn('Sign In')
        //console.log(matricula)
        
        if (accesos[matricula]) {
            if (accesos[matricula] == password) {
                console.info("Sesion iniciada")
                navigation.navigate("ProfessorsHome")
            } else{
                console.error("Matricula o Contraseña incorrectos")
            }
        } else {
            console.error("Matricula o Contraseña incorrectos")
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