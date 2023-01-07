import React, {useEffect} from 'react';

const HelloPage = () => {

  useEffect(() => {
    console.log("inside useEffect");
  }, []);


  return (
    <div>
      HelloPage - React
    </div>
  );
};

export default HelloPage;
