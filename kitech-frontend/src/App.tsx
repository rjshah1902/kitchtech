import React from 'react'
import Login from './pages/auth/Login';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Layout from './pages/components/Layout';
import store from './store';
import { Provider } from 'react-redux';

const App: React.FC = () => {

  return (
    <>
      <BrowserRouter>
        <Provider store={store}>
          <Routes>
            <Route path='/login' element={<Login />} />
          </Routes>
        </Provider>
        <Layout />
      </BrowserRouter>
    </>
  )
}

export default App;