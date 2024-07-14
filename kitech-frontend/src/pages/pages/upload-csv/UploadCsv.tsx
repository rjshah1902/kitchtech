import React, { useState, ChangeEvent, FormEvent } from 'react';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import PostMethod from '../../../apiCalls/PostMethod';
import { useNavigate } from 'react-router-dom';

const UploadCSV: React.FC = () => {

    const navigate = useNavigate();
    const [file, setFile] = useState<File | null>(null);

    const handleFileChange = (e: ChangeEvent<HTMLInputElement>) => {
        if (e.target.files && e.target.files[0]) {
            setFile(e.target.files[0]);
        }
    };

    const handleSubmit = async (e: FormEvent<HTMLFormElement>) => {
        e.preventDefault();

        if (!file) {
            toast.error("Please select a file to upload");
            return;
        }

        const url = "upload-csv/index.php?name=upload-csv";

        const formData = new FormData();
        formData.append('csv', file);

        try {

            const response = await PostMethod(url, formData);
            console.log(response);
            const { status, message } = response;
            if (status === true) {
                toast.success(message);
                navigate('/home-residents');
            } else {
                toast.error(message);
            }
        } catch (error) {
            toast.error("There was an error uploading the file");
        }
    };

    return (
        <>
            <section className="mx-auto w-full max-w-7xl px-4 py-4 mb-20">

                {/* Upload CSv Section Start */}
                <div className="row">
                    <h2 className="text-lg font-semibold">Manage Nursing Home Residents Data By CSV</h2>
                    <div className='rounded-lg bg-gray-100 py-4 px-4 mt-4'>
                        <form onSubmit={handleSubmit} method="post" autoComplete={"off"}>
                            <div className="grid gap-6 md:grid-cols-1 lg:grid-cols-4">
                                <div>
                                    <label htmlFor="">Upload CSV</label>
                                    <input type="file" required className='flex h-10 w-full rounded-md border border-gray-300  px-3 py-2 text-sm  focus:outline-none focus:ring-1focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 mt-2' name='data_csv' accept=".csv" onChange={handleFileChange} />

                                </div>
                                <div className='mt-7'>
                                    <button type='submit' className="inline-flex w-full items-center justify-center rounded-md bg-black px-3.5 py-1.5 font-semibold leading-7 text-white hover:bg-black/80"  >
                                        Upload CSV
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {/* Upload CSv Section End */}

            </section>
        </>
    );
};

export default UploadCSV;
