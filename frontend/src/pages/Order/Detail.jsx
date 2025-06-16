import { Link, useParams } from 'react-router-dom'
import { useOrder } from '../../hooks/Order/useOrder'
import { useEffect, useState } from 'react';

function Detail() {
    const { id } = useParams();

    const { order, loading, error, fetchOrder } = useOrder(id);

    const [lockButton, setLockButton] = useState(false);

    const updateOrderSituation = async (order) => {
        setLockButton(true);

        let url = `${import.meta.env.VITE_BASE_URL}/api/orders/${order.id}/situation`;

        await fetch(url, {method: 'PUT'})
            .then((response) => {
                if (response.ok) {
                    fetchOrder();
                }
            })
            .catch(error => {
                setError(error)
            })
            .finally(() => {
                setLockButton(false);
            });
    }

    useEffect(() => {
        fetchOrder();
    }, []);

    return (
        <div>
            <h1 className='title-page'>Order Details</h1>

            
                <div className="row">
                    <div className="col s12">
                        <div className="card white">
                            {(order && !loading) ? (
                                <>
                                    <div className="card-content">
                                        <div className="row">
                                            <div className="col s11">
                                                <span className="card-title">
                                                    Code: {order.code}
                                                </span>
                                            </div>
                                            <div class="col s1">
                                                <Link to="/" className='btn-floating btn-small waves-effect waves-light red lighten-2' title='Back'>
                                                    <i class="material-icons">subdirectory_arrow_left</i>
                                                </Link>
                                            </div>
                                        </div>
                                        
                                        <p>
                                            <b>Situation</b>: {order.status} 
                                        </p>
                                        <p>
                                            <b>Creation date</b>: {order.created_at}</p>
                                    </div>
                                    <div class="card-action">
                                        {order.status == 'pending' && (
                                            <button 
                                                type='button'
                                                className='btn waves-effect waves-light blue'
                                                disabled={lockButton}
                                                onClick={() => updateOrderSituation(order)} 
                                            >
                                                <i class="material-icons left">assignment</i>
                                                Start
                                            </button>
                                        )}

                                        {order.status == 'started' && (
                                            <button 
                                                type='button'
                                                className='btn waves-effect waves-light green'
                                                disabled={lockButton}
                                                onClick={() => updateOrderSituation(order)}
                                            >
                                                <i class="material-icons left">done</i>
                                                Finish
                                            </button>
                                        )}

                                        {order.status == 'finished' && (
                                            <button disabled className='btn-flat disabled'>No Actions</button>
                                        )}
                                    </div>
                                </>
                            ) : (
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
                            )}
                        </div>
                    </div>
                </div>
            
        </div>
    )
}

export default Detail