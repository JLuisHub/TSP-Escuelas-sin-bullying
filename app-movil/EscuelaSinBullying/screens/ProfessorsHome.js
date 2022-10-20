import { View, Text, StyleSheet } from 'react-native'
import React from 'react'
import SearchFunction from '../components/SearchFunction'

const ProfessorsHome = ({route, navigation}) => {
    const {clave} = route.params
    //console.log({clave})

    return (
        <View>
            <View>
                <SearchFunction clave = {clave}/>
            </View>
        </View>
    )
}

const styles = StyleSheet.create({})

export default ProfessorsHome