import React from 'react'
import Login from './pages/auth/Login';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Layout from './pages/components/Layout';

const App: React.FC = () => {

  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route path='/login' element={<Login />} />
        </Routes>
        <Layout />
      </BrowserRouter>
    </>
  )
}

export default App;