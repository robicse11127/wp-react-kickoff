import React, { useState, useEffect } from 'react';
import axios from 'axios';

const Settings = () => {
    const [ firstName, setFirstName ] = useState('');
    const [ lastName, setLastName ]   = useState('');
    const [ email, setEmail ]         = useState('');
    const [ loader, setLoader ] = useState('Save Settings')

    const url = `${appLocalizer.apiUrl}/wprk/v1/settings`;

    const handleSubmit = (e) => {
        e.preventDefault();
        setLoader( 'Saving...' );
        axios.post( url, {
            firstname: firstName,
            lastname: lastName,
            email: email,
        },{
            headers: {
                'content-type': 'application/json',
                'X-WP-NONCE': appLocalizer.nonce
            }
        } )
        .then( ( res ) => {
            setLoader( 'Save Settings' );
        } )
    }

    useEffect( () => {
        axios.get( url )
        .then( ( res ) => {
            setFirstName( res.data.firstname )
            setLastName( res.data.lastname )
            setEmail( res.data.email )
        } )
    }, [] )

    return(
        <React.Fragment>
            <h2>Settings From</h2>
            <form id="wprk-settings-form" onSubmit={ (e) => handleSubmit(e) }>
                <table className="form-table" role="presentation">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label htmlFor="firstname">Firstname</label>
                            </th>
                            <td>
                                <input id="firstname" name="firstname" value={ firstName } onChange={ (e) => { setFirstName( e.target.value ) } } className="regular-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label htmlFor="lastname">Lastname</label>
                            </th>
                            <td>
                                <input id="lastname" name="lastname" value={ lastName } onChange={ (e) => { setLastName( e.target.value ) } } className="regular-text" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label htmlFor="email">Email</label>
                            </th>
                            <td>
                                <input id="email" name="email" value={ email } onChange={ (e) => { setEmail( e.target.value ) } } className="regular-text" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p className="submit">
                    <button type="submit" className="button button-primary">{ loader }</button>
                </p>
            </form>
        </React.Fragment>
    )
}

export default Settings;