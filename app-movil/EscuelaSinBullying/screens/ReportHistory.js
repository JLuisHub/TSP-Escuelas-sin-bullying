import { View, Text, FlatList, StyleSheet } from 'react-native'
import React from 'react'
import ReportCard from '../components/ReportCard'
import CustomButton from '../components/CustomButton'
import {useNavigation} from '@react-navigation/native'

function ReportHistory ({route, navigation}) {
    const {matricula, nombre} = route.params
    console.log(nombre)
    //const navigation = useNavigation()

    const onPressAddReport = () => {
        //Aqui realiza una consulta SQL para traer los datos de ese alumno por la matricula
        navigation.navigate('Report', {nombre: nombre, matricula: matricula})
    }

    //Este array en realidad va cargar los reportes traidos por una query
    this.arrayNew = [
        { id: 1, description: 'Hizo una travesura con Robert, pero son muy buena gente todos ellos bla bla bla bla', date: 'A date1' },
        { id: 2, description: 'Hizo una travesura con Bryan', date: 'A date2' },
        { id: 3, description: 'Hizo una travesura con Vicente', date: 'A date3' },
        { id: 4, description: 'Hizo una travesura con Tristan', date: 'A date4' },
        { id: 5, description: 'Hizo una travesura con Marie', date: 'A date5' },
        { id: 6, description: 'Hizo una travesura con Onni', date: 'A date6' },
      ];   


    renderSeparator = () => {
        return (
            <View
            style={{
                height: 3,
                width: '100%',
                backgroundColor: '#3C4D6C',
            }}
            />
        );
    };
    return (
        <View
          style={{
            padding: 20,
            width: '98%',
            alignSelf: 'center',
            justifyContent: 'center',
          }}>
            <View style = {styles.headerInfoCont}>
                <Text style = {styles.headerInfoText} >
                    Numero de Reportes:     {arrayNew.length}
                </Text>
            </View>
            <FlatList
                style = {styles.list_cont}
                data={this.arrayNew}

                renderItem={({ item }) => (
                    <ReportCard id = {item.id} desc = {item.description} date = {item.date} />
                )}
                keyExtractor={item => item.id}
                ItemSeparatorComponent={this.renderSeparator}
                ListHeaderComponent={this.renderHeader}
            />
            <View style = {styles.button_cont}>
                <CustomButton text = "Nuevo Reporte" onPress = {onPressAddReport} />
            </View>
        </View>
    );
}

const styles = StyleSheet.create({
    list_cont: {
        maxHeight: '70%'
    },
    headerInfoCont: {
        marginBottom: 10,
        padding: 10,
        maxHeight: '20%',
    },

    headerInfoText: {
        color: "black",
        fontSize: 40,
        fontWeight: 'bold',
    },

    button_cont: {
        maxHeight: '20%',
        width: '70%',
        alignSelf: 'center'
    }
})

export default ReportHistory