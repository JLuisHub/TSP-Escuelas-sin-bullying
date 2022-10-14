import { StyleSheet, Text, TouchableOpacity, View } from 'react-native'
import React from 'react'

const Button = (params) => {

    const { onPress, text, type = "PRIMARY"} = params;

  return (

    <TouchableOpacity 
    style = {[styles.buttonContainer]}
    onPress = { onPress }>

        <Text style = {[styles.buttonText]}>
            {text}
        </Text>

    </TouchableOpacity>

  )
}


export default Button

const styles = StyleSheet.create({

    buttonContainer: {
        backgroundColor:"#001640",
        paddingVertical: 20,
        width: "100%",
        alignSelf: 'center',
        borderRadius: 50,
        borderWidth: 5,
        borderColor: "#e8e8e8",
    },

    buttonText: {
        color: "white",
        fontSize: 20,
        fontWeight: 'bold',
        alignSelf: 'center'
    }

})