import { useEffect, useState } from 'react';
import { useOrders } from '../../hooks/Order/useOrders'
import { Link } from 'react-router-dom';

function Index() {
    const { orders, loading, error, fetchOrders } = useOrders();

    const [codeQuery, setCodeQuery] = useState(null);
    const [statusQuery, setStatusQuery] = useState(null);

    useEffect(() => {
        fetchOrders();
    }, []);

    const handleSearchSubmit = (e) => {
        e.preventDefault();

        if (!codeQuery && !statusQuery) {
            return false;
        }

        fetchOrders(codeQuery, statusQuery);
    }

    return (
        <div>
            <h1 className='title-page'>Orders:</h1>

            <div className="row">
                <form onSubmit={handleSearchSubmit} className="col s12 search-form">
                    <div className="input-field col s4 offset-s1">
                        <input 
                            type="number" 
                            name="code" 
                            placeholder='Enter the order code'
                            maxLength="6"
                            onChange={(e) => setCodeQuery(e.target.value)}
                        />
                    </div>
                    <div className="input-field col s4">
                        
                            <select  
                                className='browser-default'
                                name="status"
                                onChange={(e) => setStatusQuery(e.target.value)}
                            >
                                <option value="" disabled selected>Choose an status</option>
                                <option value="pending">Pending</option>
                                <option value="started">Started</option>
                                <option value="finished">Finished</option>
                            </select>
                    </div>
                    <div className="input-field col s2">
                        <button className="btn waves-effect waves-light btn-large" title='search'>
                            <i class="material-icons">search</i>
                        </button>
                    </div>       
                </form>
            </div>

            <table className='highlight centered order-list'>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    {(orders && !loading) ? orders.map((order) => (
                        <tr>
                            <td>{order.code}</td>
                            <td>{order.status}</td>
                            <td>
                                <Link to={`/details/${order.id}`} className='waves-effect waves-light btn-small'>
                                    Details
                                </Link>
                            </td>
                        </tr>
                    )) : (
                        <tr>
                            <td colSpan={3}>
                                <div className='row'>
                                    <div className='col sm-1 offset-s5'>
                                        <div className='loader'>
                                            <div className="preloader-wrapper active">
                                                <div className="spinner-layer spinner-red-only">
                                                    <div className="circle-clipper left">
                                                        <div className="circle"></div>
                                                    </div><div className="gap-patch">
                                                        <div className="circle"></div>
                                                    </div><div className="circle-clipper right">
                                                        <div className="circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    )}
                </tbody>
            </table>
        </div>
    )
}

export default Index