import { StyleSheet, TextInput, View } from 'react-native'
import React, {useState} from 'react'

const CustomInput= ({ value, setValue, placeholder, secureTextEntry, keyboardType }) => {
  return (
    <View style = {[styles.container]}>
        <TextInput
            keyboardType= {keyboardType}
            placeholder = {placeholder}
            onChangeText = {newValue => setValue(newValue)}
            
            value = {value}
            secureTextEntry = {secureTextEntry}
        />
    </View>
  )
}

const styles = StyleSheet.create({
    container: {
        backgroundColor: "white",
        width: "100%",

        borderColor: "#e8e8e8",
        borderWidth: 5,
        borderRadius: 30,

        paddingHorizontal: 20,
        marginVertical: 5,
    },
})

export default CustomInput;