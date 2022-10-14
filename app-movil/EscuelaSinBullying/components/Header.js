import {StyleSheet, Text, SafeAreaView} from 'react-native'
import React from 'react'

const Header = (params) =>  {

    const {title} = params;

    return (
        <SafeAreaView style = {[styles.container]}>
            <Text style = {[styles.text]}>
                {title}
            </Text>
        </SafeAreaView>
    )
}

export default Header

const styles = StyleSheet.create({

    container:{
        backgroundColor: "#001640",
        alignItems: 'center',
        paddingVertical: 30,

    },

    text: {
        fontSize: 25,
        fontWeight: 'bold',
        color: "white",
    }

})