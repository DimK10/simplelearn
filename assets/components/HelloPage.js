import React, {useEffect} from 'react';
import { Card } from 'mdb-ui-kit';

const HelloPage = () => {

  useEffect(() => {
    console.log("inside useEffect");
  }, []);


  return (
    <div>
      HelloPage - React
      <button type="button" className="btn btn-primary">Button</button>
      <div className="card">
        <div className="card-body">
          <h5 className="card-title">Card title</h5>
          <p className="card-text">Some quick example text to build on the card title and
            make up the bulk of the card's content.</p>
          <button type="button" className="btn btn-primary">Button</button>
        </div>
      </div>
    </div>
  );
};

export default HelloPage;
