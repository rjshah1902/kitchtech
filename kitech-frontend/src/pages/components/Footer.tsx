import React from 'react'

const Footer: React.FC = () => {
    return (
        <>
            <section className="overflow-hidden bg-gray-100 fixed bottom-0 w-full">
                <div className="container relative z-10 mx-auto px-4">
                    <div className="text-center py-4">
                        Copywrite © {new Date().getFullYear()}
                    </div>
                </div>
            </section>

        </>
    )
}

export default Footer