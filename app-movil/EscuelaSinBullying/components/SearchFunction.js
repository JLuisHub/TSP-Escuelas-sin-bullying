import React, { Component } from 'react';
import { View, Text, FlatList, TextInput, ListItem, ScrollView } from 'react-native';
import StudentCard from './StudentCard';

class SearchFunction extends Component {
  constructor(props) {
    super(props);

    // Aqui va un query que va traer la matricula y nombres de todos los alumnos
    this.arrayNew = []
    this.dataArrayNew = this.getData()

    this.state = {
      data: this.dataArrayNew,
      value: '',
    };
  }

  getData = () => {
    
    fetch('http://10.2.54.125:8000/allEstudiantes/' + this.props.clave, {
        method: 'GET'
        //Request Type
    })
    .then((response) => response.json())
    //If response is in json then in success
    .then((response) => {
        //Success 
        response.forEach(element => {
          tempSet = {matricula: element['Matricula'], 
                     nombre: (element['Nombre'] + ' ' + element['Apaterno'])}
          
          this.arrayNew.push(tempSet)
        });
        return this.arrayNew
    })
    //If response is not in json then in error
    .catch((error) => {
        //Error 
        console.error(error);
    });
  }

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

  searchItems = text => {
    let newData = this.arrayNew.filter(item => {
      const itemData = `${item.nombre.toUpperCase()}`;
      const textData = text.toUpperCase();
    if(text.length > 0 ){
      return itemData.indexOf(textData) > -1;
    }

    });
    this.setState({
      data: newData,
      value: text,
    });
  };

  renderHeader = () => {
    return (
      <TextInput
        style={{backgroundColor: "white", height: 60, borderColor: '#e8e8e8', borderWidth: 3, borderRadius: 30, paddingHorizontal: 30 }}
        placeholder="Buscar Alumno por nombre..."
        onChangeText={text => this.searchItems(text)}
        value={this.state.value}
      />
    );
  };

  render() {
    return (
      <View
        style={{
          padding: 25,
          width: '98%',
          alignSelf: 'center',
          justifyContent: 'center',
        }}>
        <FlatList
          data={this.state.data}
          renderItem={({ item }) => (
            <StudentCard matricula={item.matricula} nombre={item.nombre} />
          )}
          keyExtractor={item => item.matricula}
          ItemSeparatorComponent={this.renderSeparator}
          ListHeaderComponent={this.renderHeader}
        />
      </View>
    );
  }
}

export default SearchFunction;