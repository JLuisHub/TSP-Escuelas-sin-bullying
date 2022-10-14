import {
	ActivityIndicator,
	SafeAreaView,
	StyleSheet,
	Text,
	View,
} from 'react-native';

//import { StatusBar } from 'expo-status-bar';

import React from 'react';
import Navigation from './navigation';
import ProfessorsHome from './screens/ProfessorsHome';
import SignInScreen from './screens/SignInScreen';

const App = () => {
	return (
		<View style = {[styles.container]}>
			<Navigation />
		</View>
	)

};


const styles = StyleSheet.create({
	container:{
		flex: 1,
    	backgroundColor: "#F1F1F1",
    
	}
})
 
export default App;