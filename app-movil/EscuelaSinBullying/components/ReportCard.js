import { View, Text, StyleSheet } from 'react-native'
import React from 'react'
import CustomButton from './CustomButton'

const ReportCard = ({id, desc, date}) => {

    const onDeletePress = () => {
        console.log("Se elimina el reporte con id: " + id)
    }
    
    return (
        <View style = {styles.cardCont}>

            <View style = {styles.subCardCont}>

                <Text style = {styles.infoHeader}>
                    Fecha: 
                </Text>

                <Text style = {styles.info}>
                    {date}
                </Text>

            </View>

            <View style = {styles.subCardCont}>

                <View style = {{flex:4}}>
                    <Text style = {styles.infoHeader}>
                        Descripcion:
                    </Text>

                    <Text style = {styles.info}>
                        {desc}
                    </Text>
                </View>

                <View style = {styles.buttonCont}>
                    <CustomButton 
                        text = 'Eliminar'
                        onPress = {onDeletePress}
                    />
                </View>
                
            </View>
        </View>
    )
}

const styles = StyleSheet.create({
    cardCont: {
        //padding: 3,
        marginVertical: 20
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
        flex: 1,
    },

    buttonCont: {
        alignSelf: 'flex-end',
        flex: 2
    }
})

export default ReportCard