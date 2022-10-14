import { Image, View, Text, StyleSheet, TouchableOpacity } from 'react-native'
import React from 'react'
import { useNavigation } from '@react-navigation/native'

const StudentCard = ({matricula, nombre}) => {

    const navigation = useNavigation();
    //console.log(nombre)

    const onCardPress = () =>{
        navigation.navigate('History',{matricula: matricula, nombre: nombre})
    }

    return (
        <TouchableOpacity style={[styles.cardCont]} onPress={onCardPress} >
            <View style={[styles.infoCont]} >
                <Text style={styles.infoText} > {nombre} </Text>
                <Text style={styles.infoText} > {matricula} </Text>
            </View>
            <View style={[styles.arrowCont]} >
            <Image style={styles.arrow} source={require('../assets/img/right-chevron.png')}/>
            </View>
        </TouchableOpacity>
    )
}

const styles = StyleSheet.create({
    cardCont: {
        flexDirection: "row",
        backgroundColor: "white",
        marginVertical: 10,
        maxHeight: 100,

        borderWidth: 3,
        borderColor: "#e8e8e8",
        borderRadius: 20
    },
    infoCont: {
        flex: 3,
        justifyContent: 'center',
        paddingHorizontal: 15
    },
    infoText: {
        padding: 1, 
        fontSize: 20,
        color: "#3C4D6C",
        fontWeight: 'bold',
    },
    arrowCont: {
        flex: 1,
        justifyContent:'center',
    },
    arrow: {
        maxHeight: 50,
        width: 50,
        resizeMode: 'stretch',
    }
})

export default StudentCard