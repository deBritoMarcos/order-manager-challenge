// Styles
import './App.css'

// Hooks
import {BrowserRouter, Routes, Route} from 'react-router-dom'

// Pages
import Index from './pages/Order/Index'
import Detail from './pages/Order/Detail'

function App() {
  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route path='/' element={<Index />}></Route>
          <Route path='/details/:id' element={<Detail />}></Route>
        </Routes>
      </BrowserRouter>
      
    </>
  )
}

export default App
