import React, { Component } from 'react'
import logo from '../images/logo.png'
export default class HeaderNav extends Component{
    render(){
        <section id="header" role="header">
            <nav className="navbar navbar-expand-lg navbar-light bg-light">
                <a className="navbar-brand" href="#">
                
                <span className="appName"></span>
                </a>

                <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span className="navbar-toggler-icon"></span>
                </button>

                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                <ul className="navbar-nav mr-auto">
                    <li className="nav-item active">
                    <a className="nav-link" href="#">Home <span className="sr-only">(current)</span></a>
                    </li>
                </ul>
                
                <ul className="nav justify-content-end">
                    @if(Auth::user())
                    <li className="nav-item dropdown">
                    <a className="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Nama User
                    </a>
                    <div className="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="{{ url('/backend') }}" className="dropdown-item"><i className="fa fa-dashboard"></i> Dashboard</a>
                        <a href="{{ route('gerbang.logout') }}" className="dropdown-item"><i className="fa fa-sign-out"></i> Logout</a>

                    </div>
                    </li>
                    @else
                    <li className="nav-item">
                    <a className="nav-link" href="{{ route('gerbang.login') }}">Login</a>
                    </li>
                    @endif
                </ul>

                </div>
            </nav>
    </section>
    }
}
