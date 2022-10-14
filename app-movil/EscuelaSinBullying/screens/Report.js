import { View, Text, TextInput, StyleSheet, ScrollView } from 'react-native'
import React, {useState} from 'react'
import CustomButton from '../components/CustomButton'

function Report ({ route, navigation }) {
    const { nombre, matricula } = route.params
    const [descripcion, setDescripcion] = useState('')

    const now = new Date()

    const onSavePress = () => {
        // Aqui va query para agregar el reporte a la tabla Reportes
        datos = {"matri": matricula, "fecha": now, "descri": descripcion}
        console.log(matricula)
        console.log(descripcion)
        console.warn("Se guardó el reporte")
    }
    

  return (
    <ScrollView style = {styles.mainCont}>
      <View style = {styles.doubleColumn}>
        <Text style = {styles.title}>Reporte para: </Text>
        <Text style = {styles.title} >{nombre}</Text>
      </View>
      <View style = {styles.doubleColumn} >
        <View style = {styles.subCont}>
            <Text style = {styles.title} >Matricula: </Text>
            <Text style = {styles.infoText}>{matricula}</Text>
        </View>
        <View style = {styles.subCont} >
            <Text style = {styles.title} >Fecha: </Text>
            <Text style = {styles.infoText}> {now.getDate()}/{now.getMonth()}/{now.getFullYear()} </Text>
        </View>
      </View>

      <View style = {styles.textInputCont} >
        <Text style = {styles.title} >Descripción</Text>
        <TextInput 
            style = {styles.textInput}
            placeholder = "Descripcion"
            defaultValue = {descripcion}
            onChangeText = {newDesc => setDescripcion(newDesc)}
            multiline = {true}
            />
      </View>

      <CustomButton 
        text = 'Guardar'
        onPress = {onSavePress} />
    </ScrollView>
  )
}

const styles = StyleSheet.create({
    mainCont: {
        paddingHorizontal: 20
    },
    doubleColumn: {
        flexDirection: 'row',
        justifyContent: 'center',
        marginVertical: 30,
    },
    subCont: {
        flex: 1,
        alignItems:'center',
    },
    title: {
        fontSize: 20,
        fontWeight: 'bold',
        marginVertical: 10
    },

    infoText: {
        fontSize: 15,
        justifyContent:'center',
        textAlignVertical: 'center'
    },
    textInputCont: {
        marginVertical: 30,
    },
    textInput: {
        minHeight: 100,
        backgroundColor: "white",
        textAlignVertical: 'top',
        padding: 10,
    }
})

export default Report