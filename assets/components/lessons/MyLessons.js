import React from 'react';
import HeaderNav from "../layout/HeaderNav";

const MyLessons = () =>{
    return (
        <>
            <HeaderNav/>
            <main style={{marginTop: '58px'}}>
                <div className="container pt-4">
                    <section className="mb-4">
                        <div className="card">
                            <div className="card-header py-3">
                                <h5 className="mb-0 text-center"><strong>My Lessons Page</strong></h5>
                            </div>
                            <div className="card-body">
                                {/*<canvas className="my-4 w-100" id="myChart" height="380"></canvas>*/}
                            </div>
                        </div>
                    </section>
                </div>
            </main>
        </>
    );
}

export default MyLessons;