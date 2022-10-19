import { Text, View } from 'react-native'
import React, { Component } from 'react'

import LoginForm from "../components/LoginForm";
import Header from '../components/Header';

class LoginScreen extends Component {

  state = {
    email: '',
    password: '',
    error: null,
    sending: false
  };

  onChangeEmail = email => this.state({ email });
  onChangePassword = password => this.state({ password });
  onSubmit = async () => {
    const { email, password } = this.state;
    this.setState({ sending: true });

    try {
      pass
    } catch (error) {
      this.setState({ error: error.message });
    } finally {
      this.setState({ sending: false });
    }
  }

  render() {
    return (
      <View>
        <Header title = 'Escuela sin bullying'/>
        <LoginForm
          onChangeEmail={ this.onChangeEmail }
          onChangePassword={ this.onChangePassword }
          onSubmit={ this.onSubmit }
          formData={ this.state }
          />
      </View>
    );
  }
}

export default LoginScreen