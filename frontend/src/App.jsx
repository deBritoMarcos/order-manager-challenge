// Styles
import './App.css'

// Hooks
import {BrowserRouter, Routes, Route, Link} from 'react-router-dom'

// Pages
import Index from './pages/Order/Index'
import Detail from './pages/Order/Detail'

function App() {
  return (
    <>
      <BrowserRouter>
        <nav>
          <div className="nav-wrapper">
            <Link to="/" className="brand-logo center">Manager</Link>
          </div>
        </nav>

        <div className="container">
          <Routes>
            <Route path='/' element={<Index />}></Route>
            <Route path='/details/:id' element={<Detail />}></Route>
          </Routes>
        </div>
      </BrowserRouter>
    </>
  )
}

export default App
