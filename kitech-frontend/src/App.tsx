import React from 'react'
import Login from './pages/auth/Login';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Layout from './pages/components/Layout';
import { store, persistor } from './store';
import { Provider } from 'react-redux';
import { PersistGate } from 'redux-persist/integration/react';

const App: React.FC = () => {

  return (
    <>
      <Provider store={store}>
        <PersistGate loading={null} persistor={persistor}>
          <BrowserRouter>
            <Routes>
              <Route path='/login' element={<Login />} />
            </Routes>
            <Layout />
          </BrowserRouter>
        </PersistGate>
      </Provider>
    </>
  )
}

export default App;