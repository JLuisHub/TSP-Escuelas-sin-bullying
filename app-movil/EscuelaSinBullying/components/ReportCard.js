import { View, Text, StyleSheet } from 'react-native'
import React from 'react'

const ReportCard = ({desc, date}) => {
  return (
    <View style = {styles.cardCont}>
        <View style = {styles.subCardCont}>
            <Text style = {styles.infoHeader}> Fecha: </Text>
            <Text style = {styles.info}> {date} </Text>
        </View>
        <View >
            <Text style = {styles.infoHeader}> Descripcion: </Text>
            <Text style = {styles.info}> {desc} </Text>
        </View>
    </View>
  )
}

const styles = StyleSheet.create({
    cardCont: {
        padding: 3,
        marginVertical: 10
    },

    subCardCont: {
        flexDirection: 'row'
    },

    infoHeader: {
        fontWeight: 'bold',
        fontSize: 20,
        flex: 1,
    },

    info: {
        fontSize: 20,
    }
})

export default ReportCard